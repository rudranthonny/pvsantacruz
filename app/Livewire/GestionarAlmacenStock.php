<?php

namespace App\Livewire;

use App\Livewire\Forms\AlmacenStockForm;
use App\Models\ProductoAlmacen;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class GestionarAlmacenStock extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public AlmacenStockForm $almacenstockform;
    public $search = '';
    public $titlemodal = 'Añadir';
    public $pagina = 5;
    public $configuracion;

    public function mount(){

    }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function modal(ProductoAlmacen $productoalmacen = null)
    {
        $this->reset('titlemodal');
        $this->almacenstockform->reset();
        if ($productoalmacen->id == true) {
            $this->titlemodal = 'Editar';
            $this->almacenstockform->set($productoalmacen);
        }
    }

    public function guardar()
    {
        if (isset($this->almacenstockform->productoalmacen->id)) {$this->almacenstockform->update();}
        $this->dispatch('cerrar_modal_producto_almacen');
    }


    public function render()
    {
        $productos_almacen = ProductoAlmacen::whereExists(function ($query)  {
            $query->select()
                  ->from(DB::raw('productos'))
                  ->whereColumn('producto_almacens.producto_id', 'productos.id')
                  ->where('productos.designacion','like','%'.$this->search.'%');
        })
        ->paginate($this->pagina);

        return view('livewire.gestionar-almacen-stock', compact('productos_almacen'));
    }
}
