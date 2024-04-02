<?php

namespace App\Livewire;

use App\Models\Configuracion;
use App\Models\Posventa;
use Livewire\Component;
use Livewire\WithPagination;

class GestionarVentas extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $pagina = 5;
    public $configuracion;
    public function mount(){  $this->configuracion = Configuracion::find(1); }


    public function updatedSearch(){
        $this->resetPage();
    }


    public function render()
    {
        $posventas = Posventa::query()->orderByDesc('id');

        $posventas = $posventas->paginate($this->pagina);
        return view('livewire.gestionar-ventas', compact('posventas'));
    }
}
