<?php

namespace App\Livewire;

use App\Livewire\Forms\AlmacenForm;
use App\Models\Almacen;
use Livewire\Component;
use Livewire\WithPagination;

class GestionarAlmacen extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public AlmacenForm $almacenForm;

    public $titlemodal = 'Añadir';
    public $search = '';
    public $pagina = 5;

    public function updatedSearch(){
        $this->resetPage();
    }

    public function modal(Almacen $almacen = null)
    {
        $this->reset('titlemodal');
        $this->almacenForm->reset();
        if ($almacen->id == true) {
            $this->titlemodal = 'Editar';
            $this->almacenForm->set($almacen);
        }
    }

    public function guardar()
    {
        $this->almacenForm->store();
        $this->almacenForm->reset();
        $this->dispatch('cerrar_modal_moneda');
    }

    public function eliminar(Almacen $almacen){
        $almacen->delete();
        $this->updatedSearch();
    }

    public function render()
    {
        $almacens = Almacen::where('nombre','like','%'.$this->search.'%')->paginate($this->pagina); //metodo
        // dd($almacens);
        return view('livewire.gestionar-almacen', compact('almacens'));
    }
}
