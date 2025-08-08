<?php

namespace App\Livewire;

use App\Models\Reserva;
use Livewire\Component;
use Livewire\WithPagination;

class AdministrarReservas extends Component
{
    use WithPagination;

    public $finicio;
    public $ffinal;
    public $pagina = 10;
    public $searchCliente = '';
    public $seleccionadas = [];
    public $selectAll = false;

    protected $paginationTheme = 'bootstrap';

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->seleccionadas = Reserva::query()
                ->when($this->finicio, fn($q) =>
                    $q->whereDate('fingreso', '>=', $this->finicio)
                )
                ->when($this->ffinal, fn($q) =>
                    $q->whereDate('fingreso', '<=', $this->ffinal)
                )
                ->whereNull('posventa_detalle_id')
                ->pluck('id')
                ->toArray();
        } else {
            $this->seleccionadas = [];
        }
    }

    public function eliminarSeleccionadas()
    {
        Reserva::whereIn('id', $this->seleccionadas)
            ->whereNull('posventa_detalle_id')
            ->delete();

        $this->reset('seleccionadas', 'selectAll');
        session()->flash('message', 'Reservas seleccionadas eliminadas correctamente.');
    }

    public function updatedSearchCliente()
    {
        $this->resetPage();
    }

    public function updatedPagina()
    {
        $this->resetPage();
    }

    public function updatedFinicio()
    {
        $this->resetPage();
    }

    public function updatedFfinal()
    {
        $this->resetPage();
    }

    public function getReservasProperty()
    {
       return Reserva::query()
        ->when($this->finicio, fn($q) =>
            $q->whereDate('fingreso', '>=', $this->finicio)
        )
        ->when($this->ffinal, fn($q) =>
            $q->whereDate('fingreso', '<=', $this->ffinal)
        )
        ->when($this->searchCliente, function ($q) {
            $q->whereHas('cliente', function ($sub) {
                $sub->where('name', 'like', '%' . $this->searchCliente . '%');
            });
        })
        ->orderBy('fingreso', 'desc')
        ->paginate($this->pagina);
    }

    public function mount(){
        $this->finicio = date('Y-m-d');
        $this->ffinal = date('Y-m-d');
    }

    public function render()
    {
        return view('livewire.administrar-reservas', [
            'reservas' => $this->reservas,
        ]);
    }
}
