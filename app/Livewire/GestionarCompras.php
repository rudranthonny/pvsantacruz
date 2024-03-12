<?php

namespace App\Livewire;

use App\Livewire\Forms\ComprasForm;
use App\Models\Almacen;
use App\Models\Compra;
use App\Models\Producto;
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
    public $buscar_producto = '';
    public $buscar_producto_oculto = '';

    public function mount(){   }

    public function updatedSearch(){
        $this->resetPage();
    }
    public function updatedBuscarProductoOculto()
    {
        $bproducto = Producto::where('codigo',$this->buscar_producto)->first();
        if ($bproducto)
        {
            $this->comprasForm->detalle_compra[$bproducto->codigo]['nombre_producto'] = $bproducto->designacion;
            $this->comprasForm->detalle_compra[$bproducto->codigo]['costo_unitario'] = 10;
            $this->comprasForm->detalle_compra[$bproducto->codigo]['stock_actual'] = 12;
            $this->comprasForm->detalle_compra[$bproducto->codigo]['cantidad'] = 1;
            $this->comprasForm->detalle_compra[$bproducto->codigo]['Descuento'] = 1;
            $this->comprasForm->detalle_compra[$bproducto->codigo]['impuesto'] = 1;
            $this->comprasForm->detalle_compra[$bproducto->codigo]['total_parcial'] = 1;
        }
        else {}
    }
    public function updatedBuscarProducto(){$this->dispatch('activar_buscador_producto');}

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
