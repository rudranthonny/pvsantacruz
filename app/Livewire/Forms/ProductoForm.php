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
    public $categoria_id;
    public $precio;
    public $unidad;
    public $cantidad;

    public function set(Producto $producto)
    {
        $this->producto = $producto;
        $this->designacion = $producto->designacion;
        $this->imagen = $producto->imagen;
        $this->tipo = $producto->tipo;
        $this->codigo = $producto->codigo;
        $this->marca = $producto->marca;
        $this->categoria_id = $producto->categoria_id;
        $this->precio = $producto->precio;
        $this->unidad = $producto->unidad;
        $this->cantidad = $producto->cantidad;
    }

    public function update()
    {
        $this->producto->update($this->all());
    }

    public function store($imagen = null)
    {
        $this->validate();
        if (isset($this->producto)) {
            $this->update();
        } else {
            $this->producto = Producto::create($this->all());
        }

        if ($imagen) {
            $this->eliminar_imagen_producto();
            $this->subir_imagen_producto($imagen);
        }
    }

    public function eliminar_imagen_producto()
    {
        if ($this->producto->imagen) {
            $filePath = storage_path('app/' . $this->producto->imagen);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }

    public function subir_imagen_producto($imagen)
    {
        $extension = $imagen->extension();
        $img_producto = $imagen->storeAs('producto_img', $this->producto->id . "-" . strtotime(date('Y-m-d h:i:s')) . "." . $extension);
        $this->producto->imagen = $img_producto;
        $this->producto->save();
    }
}
