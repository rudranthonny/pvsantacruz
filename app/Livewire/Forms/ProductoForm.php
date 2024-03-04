<?php

namespace App\Livewire\Forms;

use App\Models\Producto;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductoForm extends Form
{
    public ?Producto $producto;

    #[Rule('required')]
    public $designacion;
    public $imagen;
    public $tipo;
    public $codigo;
    public $marca;
    public $categoria;
    public $precio;
    public $unidad;
    public $cantidad;

    public function set(Producto $producto){
        $this->producto = $producto;
        $this->designacion = $producto->designacion;
        $this->imagen = $producto->imagen;
        $this->tipo = $producto->tipo;
        $this->codigo = $producto->codigo;
        $this->marca = $producto->marca;
        $this->categoria = $producto->categoria;
        $this->precio = $producto->precio;
        $this->unidad = $producto->unidad;
        $this->cantidad = $producto->cantidad;
    }

    public function update(){
        $this->producto->update($this->all());
        //$this->producto->save();
    }

    public function store()
    {
        $this->validate();
        if (isset($this->producto)) {
            $this->update();
        } else {
            Producto::create($this->all());
        }
    }
}
