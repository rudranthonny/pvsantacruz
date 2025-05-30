<?php

namespace App\Livewire;

use App\Models\Cliente;
use App\Models\Reserva;
use Livewire\Component;
use Livewire\WithPagination;

class PacientesReservas extends Component
{
    use WithPagination;

    public $cliente;
    public $seleccionadas = [];
    public $selectAll = false;

    protected $paginationTheme = 'bootstrap';


    public function mount($id)
    {
        $this->cliente = Cliente::findOrFail($id);
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->seleccionadas = Reserva::where('cliente_id', $this->cliente->id)
                ->whereNull('posventa_detalle_id')
                ->pluck('id')
                ->toArray();
        } else {
            $this->seleccionadas = [];
        }
    }

    public function getReservasProperty()
    {
        return Reserva::where('cliente_id', $this->cliente->id)
                      ->orderBy('fingreso', 'desc')
                      ->paginate(1000);
    }

    public function eliminarSeleccionadas()
    {
        Reserva::whereIn('id', $this->seleccionadas)
            ->whereNull('posventa_detalle_id')
            ->delete();

        $this->reset('seleccionadas');
        session()->flash('message', 'Reservas seleccionadas eliminadas correctamente.');
    }

    public function eliminarSinDetalle()
    {
        Reserva::where('cliente_id', $this->cliente->id)
            ->whereNull('posventa_detalle_id')
            ->delete();

        $this->resetPage();
        session()->flash('message', 'Todas las reservas sin detalle han sido eliminadas.');
    }

    public function render()
    {
        return view('livewire.pacientes-reservas', [
            'reservas' => $this->reservas,
        ])->extends('administrador.reservas.index_reservas_pacientes');
    }
}