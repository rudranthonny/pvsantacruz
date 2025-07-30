<?php

namespace App\Livewire;

use App\Livewire\Forms\ReservacionForm;
use App\Models\Reserva;
use Livewire\Component;

class ModalReserva extends Component
{
    public ReservacionForm $reservaform;
    public $motivo_anulacion;


     public function mount($id)
    {
        $reserva = Reserva::find($id);
        $this->reservaform->reset();
        $this->reservaform->set($reserva);
    }

    public function solicitar_anulacion()
    {
        $this->validate(['motivo_anulacion' => 'required']);
        $this->reservaform->reserva->motivo_anulacion = $this->motivo_anulacion;
        $this->reservaform->reserva->save();
        $this->reset('motivo_anulacion');
    }

    public function render()
    {
        return view('livewire.modal-reserva')->extends('administrador.reservas.index_modal_reservas');
    }
}
