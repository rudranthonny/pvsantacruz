<?php

namespace App\Livewire\Forms;

use App\Models\Producto;
use App\Traits\ImagenTrait;
use Illuminate\Validation\Rule;
use Livewire\Form;

class ProductoForm extends Form
{
    use ImagenTrait;

    public ?Producto $producto;

    public $designacion;
    public $simbologia;
    public $codigo;
    public $marca_id;
    public $impuesto_orden;
    public $metodo_impuesto;
    public $categoria_id;
    public $descripcion;
    public $tipo;
    public $costo;
    public $precio;
    public $unitario;
    public $venta_unidad;
    public $compra_unidad;
    public $alerta_stock;
    public $imagen;
    public $regla_producto = [
        'designacion' => 'required',
        'simbologia' => 'required',
        'codigo' => 'required|unique:productos,codigo',
        'categoria_id' => 'required',
        'tipo' => 'required',
        'costo' => 'required',
        'unitario' => 'required',
        'venta_unidad' => 'required',
        'compra_unidad' => 'required',
        'precio' => 'required',
        'metodo_impuesto' => 'required',
    ];

    public function set(Producto $producto)
    {
        $this->producto = $producto;
        $this->designacion = $producto->designacion;
        $this->simbologia = $producto->simbologia;
        $this->codigo = $producto->codigo;
        $this->marca_id = $producto->marca_id;
        $this->impuesto_orden = $producto->impuesto_orden;
        $this->metodo_impuesto = $producto->metodo_impuesto;
        $this->categoria_id = $producto->categoria_id;
        $this->descripcion = $producto->descripcion;
        $this->tipo = $producto->tipo;
        $this->costo = $producto->costo;
        $this->precio = $producto->precio;
        $this->unitario = $producto->unitario;
        $this->venta_unidad = $producto->venta_unidad;
        $this->compra_unidad = $producto->compra_unidad;
        $this->alerta_stock = $producto->alerta_stock;
    }

    public function update()
    {
        $this->validate(['codigo' => Rule::unique('productos')->ignore($this->producto)]);
        $this->producto->update($this->all());
    }

    public function store($imagen = null)
    {
        $this->validate($this->regla_producto);

        (isset($this->producto)) ? $this->update() : $this->producto = Producto::create($this->all());

        if ($imagen) {
            $this->eliminar_imagen($this->producto->imagen);
            $this->producto->update(["imagen" => $this->subir_imagen($imagen, $this->producto->id, "producto_img")]);
        }
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
