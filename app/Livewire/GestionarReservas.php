<?php

namespace App\Livewire;

use App\Livewire\Forms\PosVentaForm;
use App\Livewire\Forms\ReservacionForm;
use App\Models\Cancha;
use App\Models\Cliente;
use App\Models\Posventa;
use App\Models\Reserva;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class GestionarReservas extends Component
{

    public Cancha $cancha;
    public ReservacionForm $reservaform;
    public PosVentaForm $posventaform;
    public $titulo_agenda = 'Crear';
    public $stcliente = '';
    public $reservas = [];
    public $bcli,$bcli2;
    public $reservaciones;
    public $finicio,$ffinal,$time,$cantidad_horas;
    public $motivo_anulacion;
    public $nro_documento,$nombre_cliente,$telefono_cliente;
    public $scliente;
    public array $dias_semana = []; // Guarda los días seleccionados por el usuario


    public function UpdatedNroDocumento(){
        $bcliente = Cliente::where('nit',$this->nro_documento)->first();
       
        if ($bcliente) {
            $this->nombre_cliente = $bcliente->name;
            $this->telefono_cliente = $bcliente->telefono;
            $this->scliente = $bcliente;
        }
        else {
            $this->reset('nombre_cliente','scliente','telefono_cliente');
        }
    }

    public function getHorasSolicitadasProperty()
    {
        if (!$this->finicio || !$this->ffinal || !$this->cantidad_horas) {
            return 0;
        }

        try {
            $inicio = \Carbon\Carbon::parse($this->finicio);
            $final = \Carbon\Carbon::parse($this->ffinal);
            $dias = $inicio->diffInDays($final) + 1; // incluir el día inicial
            return $dias * $this->cantidad_horas;
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function save_reserva_gratuita()
    {
        $this->cancha->costo = 0;
        $this->reservaform->gratuito = true; # marca manual por si lo usas en `store()`
        $this->save_reserva(); # reutiliza el método existente
    }

    public function mount($id)
    {
        $this->cancha = Cancha::find($id);
        $this->posventaform->reset();
    }

    public function render()
    {
        $time = date('H-i-s');
        return view('livewire.gestionar-reservas',compact('time'))->extends('administrador.reservas.index_reservas');
    }

    public function solicitar_anulacion()
    {
        $this->validate(['motivo_anulacion' => 'required']);
        $this->reservaform->reserva->motivo_anulacion = $this->motivo_anulacion;
        $this->reservaform->reserva->save();
        $this->reset('motivo_anulacion');
    }

    public function descargar_venta_pdf(Posventa $posventa)
    {
        $this->posventaform->reset();
        return $this->posventaform->descargar_pdf($posventa);
    }

    public function obtener_reservaciones(){
      /*  $reservas = Reserva::where('activo',1)->get();
        $eventos = [];
        foreach ($reservas as $key => $reserva) {
            $habitacions = "Cancha : ";
            $color = match ($reserva->estado) 
            {
                'Reservado' => '#007bff',   // Azul
                'Utilizada' => '#28a745',   // Verde
                'Anulada'   => '#dc3545',   // Rojo
                default     => '#6c757d',   // Gris por defecto
            };
            $eventos[] = [
                'id'=> $reserva->id,
                'title' => 'R#'.$reserva->id." ".$reserva->cancha->name,
                'start' => $reserva->fingreso,
                'end' => $reserva->fsalida,
                'color' => $color,
            ];
        }
        //$reservaciones = json_encode($eventos);
        return $eventos;*/
    }

    #[On('abrir-modal-booking')]
    public function modal_booking($reserva = null,$info = null)
    {
        
        $reservaciones = json_encode($this->obtener_reservaciones());
        $this->dispatch('general_actualizar_calendario',$reservaciones);
        $this->reset('titulo_agenda','reservas','scliente','nro_documento','nombre_cliente');
        $this->reservaform->reset();
        $this->resetValidation();
        if ($reserva)
        {
            $reserva = Reserva::find($reserva);
            $this->titulo_agenda = "Modificar";
            $this->reservaform->set($reserva);
        }
        else
        {
            $this->finicio = date('Y-m-d', strtotime($info['dateStr']));
            $this->ffinal = date('Y-m-d', strtotime($info['dateStr']));
            $this->time = date('H:i:s');
            $this->cantidad_horas = 1;
        }
    }

    public function save_reserva()
    {       
        $this->validate([
            'nro_documento' => 'required',
            'nombre_cliente' => 'required',
            'finicio' => 'required|date',
            'ffinal' => 'required|date|after_or_equal:finicio',
            'time' => 'required',
            'cantidad_horas' => 'required|integer|min:1',
            'dias_semana' => 'required|array|min:1',
        ], [
            'finicio.required' => 'La fecha de inicio es obligatoria.',
            'ffinal.required' => 'La fecha final es obligatoria.',
            'ffinal.after_or_equal' => 'La fecha final no puede ser menor a la fecha de inicio.',
            'time.required' => 'La hora es obligatoria.',
            'time.date_format' => 'La hora debe tener el formato HH:MM.',
            'cantidad_horas.required' => 'Debe especificar la cantidad de horas.',
            'cantidad_horas.integer' => 'Las horas deben ser un número entero.',
            'cantidad_horas.min' => 'Debe reservar al menos 1 hora.',
            'dias_semana.required' => 'Debe seleccionar al menos un día de la semana para generar las reservas.',
        ]);
        
        $inicio = Carbon::parse($this->finicio);
        $fin = Carbon::parse($this->ffinal);
        $hora = $this->time;
        $horas = $this->cantidad_horas;
        # Creamos un rango de fechas
        $isGratisForzado = $this->reservaform->gratuito ?? false;
       
        $periodo = CarbonPeriod::create($inicio, $fin);
        
        try 
        {
            DB::beginTransaction();
            foreach ($periodo as $fecha) 
            {
                
                if (!in_array($fecha->dayOfWeek, $this->dias_semana)) {
                    continue; // saltar días que no están seleccionados
                }
               
                $fingreso = Carbon::parse($fecha->format('Y-m-d') . ' ' . $hora);
                $fsalida = $fingreso->copy()->addHours($horas);
                #Verificar colisión
                $colisiona = Reserva::where('cancha_id', $this->cancha->id)
                ->where('activo', true)
                ->where(function ($q) use ($fingreso, $fsalida) {
                    $q->where('fingreso', '<', $fsalida)
                      ->where('fsalida', '>', $fingreso);
                })->exists();

                if ($colisiona) {
                    
                    throw new \Exception("Ya existe una reserva para la fecha " . $fingreso->format('d/m/Y H:i'));
                }
                #crear el cliente en caso no exista
                if(!isset($this->scliente->id))
                {
                    $this->scliente = new Cliente();
                    $this->scliente->nit = $this->nro_documento;
                    $this->scliente->name = $this->nombre_cliente;
                    $this->scliente->telefono = $this->telefono_cliente;
                    $this->scliente->save();
                }

                $this->reservaform->reset();
                $this->reservaform->cliente_id= $this->scliente->id;
                $this->reservaform->cancha_id= $this->cancha->id;
                $this->reservaform->horas = $this->cantidad_horas;
                $this->reservaform->fingreso =  $fingreso;
                $this->reservaform->fsalida = $fsalida;
                $this->reservaform->gratuito = $isGratisForzado;
                $this->reservaform->costo = $isGratisForzado ? 0 : $this->cancha->costo;
                $this->reservaform->store();
            }
            $reservaciones = json_encode($this->obtener_reservaciones());
            DB::commit();
            $this->reservaform->reset();
            $this->dispatch('cerrar_modal_reserva',$reservaciones);
        } 
        catch (\Exception $e) 
        {
            DB::rollBack();
            $reservaciones = json_encode($this->obtener_reservaciones());
            $this->dispatch('cerrar_modal_reserva',$reservaciones);
            $this->dispatch('error',$e->getMessage());
        }
    }

    #[On('eliminar-booking-seleccionado')]
    public function eliminar_bokking(Reserva $booking)
    {
        if ($booking->booking_status == 4) {
            $booking->booking_status = 3;
        }
        else{
            $this->dispatch('error_cancelacion_reserva');
        }
        $booking->save();
        $this->agendaform->setBooking($booking);
        $reservaciones = json_encode($this->obtener_reservaciones());
        $this->dispatch('general_actualizar_calendario',$reservaciones);
    }

    public function agregar_reserva(Reserva $room)
    {
        $this->agendaform->reservas[$room->id]['numero'] = $room->numero;
        $this->agendaform->reservas[$room->id]['precio'] = 0;
        $this->agendaform->reservas[$room->id]['personas'] = 0;
        $this->agendaform->reservas[$room->id]['minimo'] = $room->floor->fprices->first()->num_persons;
        $this->agendaform->reservas[$room->id]['maximo'] = $room->floor->fprices->last()->num_persons;
        $this->agendaform->reservas[$room->id]['tipo'] = $room->type->name;
        $this->actualizar_lista_habitaciones();
    }

    public function eliminar_reserva($key)
    {
        unset($this->agendaform->reservas[$key]);
        $this->updatedAgendaformReservas();
    }

    public function obtener_dias($fecha_inicial,$fecha_final)
    {
        $dias = (strtotime($fecha_inicial)-strtotime($fecha_final))/86400;
        $dias = abs($dias);
        $dias = floor($dias);
        return $dias;
    }
}
