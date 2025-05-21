<?php

namespace App\Console\Commands;

use App\Livewire\Forms\CajaForm;
use App\Livewire\Forms\PosVentaForm;
use App\Models\Almacen;
use App\Models\Caja;
use App\Models\Cliente;
use App\Models\Configuracion;
use App\Models\Posventa;
use App\Models\PosventaDetalle;
use App\Models\Reserva;
use App\Models\ReservaUso;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RealizarPagosCancha extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:realizar-pagos-cancha';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Registrar las reservas';
    /**
     * Execute the console command.
     */

    public function handle()
    {
        #abrir caja
        $ahora = Carbon::now();

        $reservas = Reserva::where('estado', 'Reservado')
            ->where('fsalida', '<=', $ahora)
            ->whereNull('motivo_anulacion')
            ->whereNull('posventa_detalle_id')
            ->where('activo', true)
            ->get();
        
        foreach ($reservas as $reserva) 
        {
            #verificar si hay horas gratuitas en la reserva
            $gratuitas = Cliente::find($reserva->cliente_id)->reservas_gratuitas_disponibles;
            if ($gratuitas > 0 && $gratuitas >= $reserva->horas) 
            {
                $reserva->gratuito = true;
                $reserva->costo = 0;
                $reserva->subtotal = 0;
                $reserva->save();
                $this->registrar_reservas_utilizadas_grautitas($reserva);
            }
            
                $caja = $this->obtener_caja($reserva->user_id);
                #generar comprobante
                $comprobante = $this->generar_comprobante($reserva->cancha->almacen,$reserva->cliente,$reserva);
                #generar detalle
                $id_detalle = $this->generar_detalle($comprobante,$reserva);
                #agregar cambio de estado
                $reserva->posventa_detalle_id = $id_detalle;
                $reserva->estado = 'Utilizada';
                $reserva->save();
                #caja
                $comprobante->m_caja()->create(['tmovimiento_caja_id' => '3', 'caja_id' => $caja->id, 'signo' => '+', 'monto' => $reserva->subtotal]);
         
        }
    }

    private function registrar_reservas_utilizadas_grautitas(Reserva $reserva)
    {
        $horas = $reserva->horas;
        $cliente_id = $reserva->cliente_id;
        # 1. Obtener configuración: cuántas horas se requieren para una gratuita
        $conf = Configuracion::find(1);
        $canthoras = $conf ? $conf->gratuito : 0;
        # 2. Calcular cuántas horas previas deben haberse utilizado (ej: 1 gratuita por cada X)
        $hora_registradas = $horas * $canthoras;

        ###### paretesis si tiene horas gratuitas el cliente utilizarlo
        $cliente = Cliente::find($cliente_id);
        if ($cliente && $cliente->gratuito > 0) 
        {
            $hgratuitas_disponibles = $cliente->gratuito * $canthoras;
            if ($hgratuitas_disponibles >= $hora_registradas) 
            {
                $cliente->gratuito -= $horas;
                $cliente->save();
                $hora_registradas = 0;
                return;
            } else {
                $reservas_gratuitas_cubiertas = intdiv($hgratuitas_disponibles, $canthoras);
                $cliente->gratuito -= $reservas_gratuitas_cubiertas;
                $cliente->save();

                $hora_registradas -= $reservas_gratuitas_cubiertas * $canthoras;
            }
        }  
        # 3. Buscar reservas pagadas del cliente que están marcadas como 'Utilizada' pero aún no 'utilizado'
        $reservas_cumplidas = Reserva::where('cliente_id', $cliente_id)
            ->where('gratuito', false)
            ->where('estado', 'Utilizada')
            ->where('utilizado', false)
        ->get();
        # 4. Recorrer reservas pagadas y consumir horas disponibles hasta cumplir lo necesario
        foreach ($reservas_cumplidas as $rcumplida) 
        {
            $hora_disponible = max(0, $rcumplida->horas - $rcumplida->contador);

            if ($hora_registradas >= $hora_disponible) {
                // Se usan todas las horas disponibles de esta reserva
                $rcumplida->contador += $hora_disponible;
                $rcumplida->utilizado = true;
                $rcumplida->save();

                // Guardar trazabilidad
                ReservaUso::create([
                    'reserva_id' => $reserva->id,
                    'reserva_origen_id' => $rcumplida->id,
                    'horas_utilizadas' => $hora_disponible,
                ]);

                $hora_registradas -= $hora_disponible;
            } 
            else {
                // Solo se usa una parte de las horas disponibles
                $rcumplida->contador += $hora_registradas;
                $rcumplida->utilizado = false;
                $rcumplida->save();

                // Guardar trazabilidad
                ReservaUso::create([
                    'reserva_id' => $reserva->id,
                    'reserva_origen_id' => $rcumplida->id,
                    'horas_utilizadas' => $hora_registradas,
                ]);

                $hora_registradas = 0;
            }
            # Si ya no se necesitan más horas, salimos
            if ($hora_registradas == 0) {
                break;
            }
        }
    }

    public function obtener_caja($user_id)
    {
        #verificar si hay una caja esta abierta
        $caja = Caja::where('user_id',$user_id)->whereNull('fecha_cierre')->first();
        if (!$caja) 
        {
            $caja = new Caja();
            $caja->user_id = $user_id;
            $caja->monto = 0;
            $caja->fecha_apertura = date('Y-m-d h:i:s');
            $caja->save();
        }
        return $caja;
    }

    public function generar_comprobante(Almacen $almacen,Cliente $cliente,Reserva $reserva)
    {
        $posventa = new Posventa();
        $posventa->cajero_id = $reserva->user->id;
        $posventa->almacen_id = $almacen->id;
        $posventa->almacen_name = $almacen->nombre;
        $posventa->cliente_id = $cliente->id;
        $posventa->cliente_name = $cliente->name;
        $posventa->cliente_nit = $cliente->nit;
        $posventa->impuesto_porcentaje = 0;
        $posventa->impuesto_monto = 0;
        $posventa->descuento = 0;
        $posventa->envio = 0;
        $posventa->descuento_items = 0;
        $posventa->total_pagar_previo = $reserva->subtotal;
        $posventa->total_pagar = $reserva->subtotal;
        $posventa->cantidad_recibida = $reserva->subtotal;
        $posventa->monto_pago = $reserva->subtotal;
        $posventa->monto_pendiente = 0;
        $posventa->cambio = 0;
        $posventa->nota_venta = '';
        $posventa->nota_pago = '';
        $posventa->productos_totales = 1;
        $posventa->estado_posventa = "Completo";
        $posventa->save();
        return $posventa;
    }

    public function generar_detalle(Posventa $posventa,Reserva $reserva){
        $posventa_detalle = new PosventaDetalle();
        $posventa_detalle->producto_id = $reserva->id;
        $posventa_detalle->producto_codigo = 'RC-'.$reserva->id;
        $posventa_detalle->producto_nombre = 'Alquiler de la cancha-'.$reserva->cancha->name;
        $posventa_detalle->producto_compra = 0;
        $posventa_detalle->producto_precio = $reserva->costo;
        $posventa_detalle->producto_cantidad = $reserva->horas;
        $posventa_detalle->producto_costo_compra = 0;
        $posventa_detalle->producto_importe_previo = $reserva->subtotal;
        $posventa_detalle->producto_descuento = 0;
        $posventa_detalle->producto_precio = $reserva->subtotal;
        $posventa_detalle->producto_importe = $reserva->subtotal;
        $posventa_detalle->producto_tipo = 'A';
        $posventa_detalle->posventa_id = $posventa->id;
        $posventa_detalle->save();
        return $posventa_detalle->id;
    }
}
