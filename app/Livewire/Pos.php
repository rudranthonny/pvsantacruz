<?php

namespace App\Livewire;

use App\Models\Almacen;
use App\Models\Cliente;
use App\Models\ProductoAlmacen;
use Livewire\Component;
use PhpParser\Node\Expr\FuncCall;

class Pos extends Component
{
    public $almacen_id;
    public $cliente_id;
    public $productos;

    public function mount(){
        $this->almacen_id = Almacen::first()->id;
        $this->cliente_id = Cliente::first()->id;
        $this->productos = ProductoAlmacen::whereAlmacenId($this->almacen_id)->get();
    }

    public function updatedAlmacenId(){
        $this->productos = ProductoAlmacen::whereAlmacenId($this->almacen_id)->get();
    }

    public function render()
    {
        $clientes = Cliente::all();
        $almacenes = Almacen::all();
        return view('livewire.pos', compact('clientes', 'almacenes'))->layout('administrador.ventas.pos');
    }
}
