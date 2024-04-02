<?php

namespace App\Livewire;

use App\Exports\ReporteAlmacenStockExport;
use App\Livewire\Forms\AlmacenStockForm;
use App\Models\Almacen;
use App\Models\ProductoAlmacen;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class GestionarAlmacenStock extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public AlmacenStockForm $almacenstockform;
    public $search = '';
    public $titlemodal = 'Añadir';
    public $salmacen,$sestado;
    public $pagina = 5;
    public $configuracion;
    public $productos_almacen_export;

    public function mount(){
        $this->salmacen = Almacen::find(1) ? Almacen::find(1)->id : null;
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
        $productos_almacen = ProductoAlmacen::query()->whereExists(function ($query)  {
            $query->select()
                  ->from(DB::raw('productos'))
                  ->whereColumn('producto_almacens.producto_id', 'productos.id')
                  ->where('productos.designacion','like','%'.$this->search.'%');
        });

        $productos_almacen->when($this->salmacen <> '',function ($q) {
            return $q->where('almacen_id',$this->salmacen);
        });

        $productos_almacen->when($this->sestado == 'suficiente',function ($q) {
            return $q->where('stock','>=',3)->whereExists(function ($query)  {
                $query->select()
                      ->from(DB::raw('productos'))
                      ->whereColumn('productos.id', 'producto_almacens.producto_id')
                      ->whereRaw('producto_almacens.stock <= productos.alerta_stock');
            });
        });

        $productos_almacen->when($this->sestado == 'exceso',function ($q) {
            return $q->whereExists(function ($query)  {
                $query->select()
                      ->from(DB::raw('productos'))
                      ->whereColumn('productos.id', 'producto_almacens.producto_id')
                      ->whereRaw('producto_almacens.stock > productos.alerta_stock');
            });
        });

        $productos_almacen->when($this->sestado == 'insuficiente',function ($q) {
            return $q->where('stock','==',0);
        });

        $productos_almacen->when($this->sestado == 'poracabar',function ($q) {
            return $q->where('stock','<=',2);
        });

        $productos_almacen = $productos_almacen->paginate($this->pagina);
        $almacens = Almacen::all();
        return view('livewire.gestionar-almacen-stock', compact('productos_almacen','almacens'));
    }

    public function descargar_reporte_almacen(){
        $productos_almacen = ProductoAlmacen::query()->whereExists(function ($query)  {
            $query->select()
                  ->from(DB::raw('productos'))
                  ->whereColumn('producto_almacens.producto_id', 'productos.id')
                  ->where('productos.designacion','like','%'.$this->search.'%');
        });

        $productos_almacen->when($this->salmacen <> '',function ($q) {
            return $q->where('almacen_id',$this->salmacen);
        });

        $productos_almacen->when($this->sestado == 'suficiente',function ($q) {
            return $q->where('stock','>=',3)->whereExists(function ($query)  {
                $query->select()
                      ->from(DB::raw('productos'))
                      ->whereColumn('productos.id', 'producto_almacens.producto_id')
                      ->whereRaw('producto_almacens.stock <= productos.alerta_stock');
            });
        });

        $productos_almacen->when($this->sestado == 'exceso',function ($q) {
            return $q->whereExists(function ($query)  {
                $query->select()
                      ->from(DB::raw('productos'))
                      ->whereColumn('productos.id', 'producto_almacens.producto_id')
                      ->whereRaw('producto_almacens.stock > productos.alerta_stock');
            });
        });

        $productos_almacen->when($this->sestado == 'insuficiente',function ($q) {
            return $q->where('stock','==',0);
        });

        $productos_almacen->when($this->sestado == 'poracabar',function ($q) {
            return $q->where('stock','<=',2);
        });
        $productos_almacen =  $productos_almacen->get();
        return Excel::download(new ReporteAlmacenStockExport($productos_almacen), 'ReporteProductosAlmacen.xlsx');
    }
}
