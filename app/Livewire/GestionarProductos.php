<?php

namespace App\Livewire;

use App\Livewire\Forms\ProductoForm;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Unidad;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class GestionarProductos extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public ProductoForm $productoForm;

    public $titlemodal = 'Añadir Producto';
    public $search = '';
    public $pagina = 5;
    public $imagen_producto;
    public $iteration = 1;
    public $bproducto;

    public function updatedProductoform(){
        if($this->productoForm->tipo != 'compuesto'){
            $this->productoForm->reiniciar_productos_compuesto();
        }
        $this->productoForm->verificar_productos();
    }

    public function agregar_producto_compuesto()
    {
        $this->productoForm->agregar_producto_compuesto($this->bproducto);
        $this->reset('bproducto');
    }

    public function eliminar_producto_compuesto($item_id){
        $this->productoForm->eliminar_item_producto_compuesto($item_id);
        $this->productoForm->verificar_productos();
    }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function modal(Producto $producto = null)
    {
        $this->reset('titlemodal', 'imagen_producto','bproducto');
        $this->iteration++;
        $this->productoForm->reset();
        $this->productoForm->resetValidation();
        if ($producto->id == true) {
            $this->titlemodal = 'Editar Producto';
            $this->productoForm->set($producto);
        }
    }

    public function guardar()
    {
        $this->productoForm->store($this->imagen_producto);
        $this->productoForm->reset();
        $this->productoForm->resetValidation();
        $this->dispatch('cerrar_modal_producto');
    }

    public function eliminar(Producto $producto){
        $producto->delete();
        $this->updatedSearch();
    }

    public function generar_codigo(){
        $bcodigo = true;
        while ($bcodigo == true) {
            $codigo = rand(10000000,99999999);
            $bcodigo = Producto::where('codigo',$codigo)->first();
        }
        $this->productoForm->codigo = $codigo;
    }

    public function render()
    {
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $unidades = Unidad::all();
        $lista_productos = Producto::where('designacion','like','%'.$this->search.'%')->paginate($this->pagina);
        return view('livewire.gestionar-productos', compact('lista_productos', 'categorias', 'marcas', 'unidades'));
    }
}
