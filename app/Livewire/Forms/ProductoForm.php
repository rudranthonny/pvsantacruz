<?php

namespace App\Livewire\Forms;

use App\Models\Producto;
use App\Models\Unidad;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductoForm extends Form
{
    public ?Producto $producto;

    public $designacion;
    public $imagen;
    public $tipo;
    public $codigo;
    public $marca_id;
    public $categoria_id;
    public $unidad_id;
    public $precio;
    public $cantidad;

    public function set(Producto $producto)
    {
        $this->producto = $producto;
        $this->designacion = $producto->designacion;
        $this->imagen = $producto->imagen;
        $this->tipo = $producto->tipo;
        $this->codigo = $producto->codigo;
        $this->marca_id = $producto->marca_id;
        $this->categoria_id = $producto->categoria_id;
        $this->precio = $producto->precio;
        $this->unidad_id = $producto->unidad_id;
        $this->cantidad = $producto->cantidad;
    }

    public function update()
    {
        $this->validate(['codigo' => Rule::unique('productos')->ignore($this->producto)]);

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

    public function rules()
    {
        return [
            'designacion' => 'required',
            'marca_id' => [
                'required',
                Rule::exists('marcas', 'id')
            ],
            'categoria_id' => [
                'required',
                Rule::exists('categorias', 'id')
            ],
            'unidad_id' => [
                'required',
                Rule::exists('unidads', 'id')
            ],
            'codigo' => [
                'required',
                'min:5',
            ],
            'precio' => [
                'required',
                'numeric',
                'gt:0'
            ],
            'cantidad' => [
                'required',
                'numeric',
                'gt:0'
            ],
        ];
    }
}
