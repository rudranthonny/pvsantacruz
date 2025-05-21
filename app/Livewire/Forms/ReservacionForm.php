<?php

namespace App\Livewire\Forms;

use App\Models\Cliente;
use App\Models\Configuracion;
use App\Models\Reserva;
use App\Models\ReservaUso;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ReservacionForm extends Form
{
    public ?Reserva $reserva;

    #[Rule('required|date')]
    public $fingreso;

    #[Rule('required|date|after_or_equal:fingreso')]
    public $fsalida;

    #[Rule('required|integer|min:1')]
    public $horas;

    #[Rule('required|numeric|min:0')]
    public $costo;
    public $subtotal;

    #[Rule('required|exists:canchas,id')]
    public $cancha_id;

    #[Rule('required|exists:clientes,id')]
    public $cliente_id;

    public $user_id;
    public $gratuito = false;

    #[Rule('required|in:Disponible,Reservado,Utilizado,Cancelado')]
    public $estado = 'Reservado';

    public function set(Reserva $reserva)
    {
        $this->reserva = $reserva;
        $this->fingreso = $reserva->fingreso;
        $this->fsalida = $reserva->fsalida;
        $this->horas = $reserva->horas;
        $this->costo = $reserva->costo;
        $this->subtotal = $reserva->subtotal;
        $this->cancha_id = $reserva->cancha_id;
        $this->cliente_id = $reserva->cliente_id;
        $this->user_id = $reserva->user_id;
        $this->estado = $reserva->estado;
    }

    public function store()
    {
        $this->validate();   
        $this->subtotal = $this->costo*$this->horas;
        $this->user_id = Auth::user()->id;
        $this->reserva = Reserva::create([
            'fingreso' => $this->fingreso,
            'fsalida' => $this->fsalida,
            'horas' => $this->horas,
            'costo' => $this->costo,
            'subtotal' => $this->subtotal,
            'cancha_id' => $this->cancha_id,
            'cliente_id' => $this->cliente_id,
            'user_id' => $this->user_id,
            'estado' => $this->estado,
            'gratuito' => $this->gratuito,
        ]);

        if ($this->gratuito) {$this->registrar_reservas_utilizadas_grautitas();}
        

        return 'Reserva creada correctamente';
    }

    private function registrar_reservas_utilizadas_grautitas()
    {
        # 1. Obtener configuración: cuántas horas se requieren para una gratuita
        $conf = Configuracion::find(1);
        $canthoras = $conf ? $conf->gratuito : 0;
        # 2. Calcular cuántas horas previas deben haberse utilizado (ej: 1 gratuita por cada X)
        $hora_registradas = $this->horas * $canthoras;

        ###### paretesis si tiene horas gratuitas el cliente utilizarlo
        $cliente = Cliente::find($this->cliente_id);
        if ($cliente && $cliente->gratuito > 0) 
        {
            $hgratuitas_disponibles = $cliente->gratuito * $canthoras;
            if ($hgratuitas_disponibles >= $hora_registradas) 
            {
                $cliente->gratuito -= $this->horas;
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
        $reservas_cumplidas = Reserva::where('cliente_id', $this->cliente_id)
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
                    'reserva_id' => $this->reserva->id,
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
                    'reserva_id' => $this->reserva->id,
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

    public function update()
    {
        $this->validate();

        $this->reserva->update([
            'fingreso' => $this->fingreso,
            'fsalida' => $this->fsalida,
            'horas' => $this->horas,
            'costo' => $this->costo,
            'subtotal' => $this->subtotal,
            'cancha_id' => $this->cancha_id,
            'cliente_id' => $this->cliente_id,
            'user_id' => $this->user_id,
            'estado' => $this->estado,
        ]);

        return 'Reserva actualizada correctamente';
    }

    #########################################################
}
