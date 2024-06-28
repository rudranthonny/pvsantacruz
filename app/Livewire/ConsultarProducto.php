<?php

namespace App\Livewire;

use App\Models\Configuracion;
use App\Models\Producto;
use App\Models\ProductoAlmacen;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ConsultarProducto extends Component
{
    public $producto;
    public $configuracion;
    public $salmacen;
    public function mount($id)
    {
        $this->producto = Producto::find($id);
        $this->configuracion = Configuracion::find(1);
    }

    public function habilitar_producto_almacen()
    {
        $this->validate(['salmacen' => 'required'],['salmacen' => 'se necesita seleccionar Almacen']);
        $n_pro_alm = new ProductoAlmacen();
        $n_pro_alm->almacen_id = $this->salmacen;
        $n_pro_alm->producto_id = $this->producto->id;
        $n_pro_alm->stock = 0;
        $n_pro_alm->save();
        $this->reset('salmacen');
    }

    public function render()
    {
        $productoId = $this->producto->id;
        $almacenes = DB::table('almacens')
            ->whereNotIn('id', function ($query) use ($productoId) {
                $query->select('almacen_id')
                    ->from('producto_almacens')
                    ->where('producto_id', $productoId);
            })
            ->get();
        return view('livewire.consultar-producto',compact('almacenes'))->layout('administrador.productos.vista_producto');
    }
}
