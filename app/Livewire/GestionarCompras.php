<?php

namespace App\Livewire;

use App\Livewire\Forms\ComprasForm;
use App\Models\Almacen;
use App\Models\Compra;
use App\Models\Proveedor;
use Livewire\Component;
use Livewire\WithPagination;

class GestionarCompras extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public ComprasForm $comprasForm;
    public $search = '';
    public $titlemodal = 'Añadir';
    public $pagina = 5;

    public function mount(){   }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function modal(Compra $compra = null)
    {
        $this->reset('titlemodal');
        $this->comprasForm->reset();
        if ($compra->id == true) {
            $this->titlemodal = 'Editar';
            $this->comprasForm->set($compra);
        }
    }

    public function guardar()
    {
        if (isset($this->comprasForm->compra->id)) {$this->comprasForm->update();}
        else {$this->comprasForm->store();}
        $this->dispatch('cerrar_modal_compra');
    }

    public function eliminar(Compra $compra){
        $compra->delete();
        $this->updatedSearch();
    }

    public function render()
    {
        $compras = Compra::paginate($this->pagina); //metodo
        $proveedors = Proveedor::all();
        $almacens = Almacen::all();
        return view('livewire.gestionar-compras', compact('compras','proveedors','almacens'));
    }
}
