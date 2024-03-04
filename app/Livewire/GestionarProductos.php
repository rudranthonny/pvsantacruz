<?php

namespace App\Livewire;

use App\Livewire\Forms\ProductoForm;
use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;

class GestionarProductos extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public ProductoForm $productoForm;

    public $titlemodal = 'Añadir Producto';
    public $search = '';
    public $pagina = 5;

    public function updatedSearch(){
        $this->resetPage();
    }

    public function modal(Producto $producto = null)
    {
        $this->reset('titlemodal');
        $this->productoForm->reset();
        if ($producto->id == true) {
            $this->titlemodal = 'Editar Producto';
            $this->productoForm->set($producto);
        }
    }

    public function guardar()
    {
        $this->productoForm->store();
        $this->productoForm->reset();
        $this->dispatch('cerrar_modal_producto');
    }

    public function eliminar(Producto $producto){
        $producto->delete();
        $this->updatedSearch();
    }

    public function render()
    {
        $productos = Producto::where('designacion','like','%'.$this->search.'%')->paginate($this->pagina);
        return view('livewire.gestionar-productos', compact('productos'));
    }
}
