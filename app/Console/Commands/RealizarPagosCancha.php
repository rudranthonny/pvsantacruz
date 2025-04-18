<?php

namespace App\Console\Commands;

use App\Livewire\Forms\CajaForm;
use App\Livewire\Forms\PosVentaForm;
use App\Models\Almacen;
use App\Models\Caja;
use App\Models\Cliente;
use App\Models\Posventa;
use App\Models\PosventaDetalle;
use App\Models\Reserva;
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
