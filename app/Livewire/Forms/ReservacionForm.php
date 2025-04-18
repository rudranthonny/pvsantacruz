<?php

namespace App\Livewire\Forms;

use App\Models\Reserva;
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

        return 'Reserva creada correctamente';
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
}
