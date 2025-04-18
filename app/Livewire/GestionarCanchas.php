<?php

namespace App\Livewire;

use App\Livewire\Forms\CanchaForm;
use App\Models\Almacen;
use App\Models\Cancha;
use App\Models\Reserva;
use Livewire\Component;
use Livewire\WithPagination;

class GestionarCanchas extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public CanchaForm $canchaform;
    public $almacenes;
    public $titulo_cancha = 'Crear';
    public $n_pagina = 100;
    public $scancha;

    public function mount(){$this->almacenes = Almacen::all();}

    public function aceptar_anulacion(Reserva $reserva){
        $reserva->estado = 'Anulada';
        $reserva->save();
        $this->dispatch('success','Se Anulo la reserva');
    }

    public function cancelar_anulacion(Reserva $reserva){
        $reserva->motivo_anulacion = NULL;
        $reserva->save();
        $this->dispatch('success','Se Rechazo la Solcitud de Anulación');
    }


    public function seleccionar_cancha(Cancha $cancha){$this->scancha = $cancha;}

    public function consultar_reserva(Cancha $cancha)
    {
        return redirect()->route('admin.reservas', $cancha->id);
    }

    public function modal_cancha(Cancha $cancha)
    {
        $this->resetErrorBag();
        $this->canchaform->reset();
        $this->titulo_cancha = $cancha && $cancha->id ? 'Editar' : 'Crear';

        if ($cancha) {
            $this->canchaform->set($cancha);
        }
    }

    public function save_cancha()
    {
        $mensaje = isset($this->canchaform->cancha->id)
            ? $this->canchaform->update()
            : $this->canchaform->store();

        $this->dispatch('cerrar_modal_cancha');
        $this->dispatch('success', $mensaje);
    }

    public function eliminar_cancha(Cancha $cancha)
    {
        $cancha->activo = false;
        $cancha->save();
        $this->dispatch('success', 'Cancha eliminada correctamente');
    }

    public function render()
    {
        return view('livewire.gestionar-canchas', [
            'canchas' => Cancha::where('activo',true)->latest()->paginate($this->n_pagina),
        ]);
    }
}