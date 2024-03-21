<?php

namespace App\Livewire;

use App\Models\Almacen;
use App\Models\Cliente;
use App\Models\ProductoAlmacen;
use Livewire\Component;

class Pos extends Component
{
    public $almacen_id;
    public $cliente_id;
    public $productos;
    public $categorias;
    public $categoria_id;
    public $marcas;
    public $marca_id;

    public function mount()
    {
        $this->almacen_id = Almacen::first()->id;
        $this->cliente_id = Cliente::first()->id;
        $this->updatedAlmacenId();
    }

    public function updatedAlmacenId()
    {
        $this->productos = ProductoAlmacen::with('producto', 'producto.categoria', 'producto.marca', 'producto.unidad')->where('almacen_id', $this->almacen_id)->get();
        $this->categorias = $this->productos->pluck('producto.categoria')->unique();
        $this->marcas = $this->productos->pluck('producto.marca')->unique();
        $this->reset(['categoria_id', 'marca_id']);
    }

    public function updatedCategoriaId()
    {
        $this->productos = ProductoAlmacen::with('producto', 'producto.categoria', 'producto.marca', 'producto.unidad')->where('almacen_id', $this->almacen_id)
        ->whereHas('producto.categoria', function ($query) {
            if ($this->categoria_id) {
                $query->where('id', $this->categoria_id);
            }
        })
        ->whereHas('producto.marca', function ($query) {
            if ($this->marca_id) {
                $query->where('id', $this->marca_id);
            }
        })
        ->get();
    }

    public function updatedMarcaId(){
        $this->updatedCategoriaId();
    }

    public function render()
    {
        $clientes = Cliente::all();
        $almacenes = Almacen::all();
        return view('livewire.pos', compact('clientes', 'almacenes'))->layout('administrador.ventas.pos');
    }
}
