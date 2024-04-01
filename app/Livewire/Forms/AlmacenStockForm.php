<?php

namespace App\Livewire\Forms;

use App\Models\ProductoAlmacen;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AlmacenStockForm extends Form
{
    public ?ProductoAlmacen $productoalmacen;

    #[Rule('required')]
    public $producto_id;
    public $almacen_id;
    public $stock;

    public function set(ProductoAlmacen $productoalmacen){
        $this->productoalmacen = $productoalmacen;
        $this->producto_id = $productoalmacen->producto_id;
        $this->almacen_id = $productoalmacen->almacen_id;
        $this->stock = $productoalmacen->stock;
    }

    public function update(){
        $this->validate();
        $this->productoalmacen->update($this->all());
    }
}
