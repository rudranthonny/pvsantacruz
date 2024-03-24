<?php

namespace App\Livewire\Forms;

use App\Models\CompuestoProducto;
use App\Models\Producto;
use App\Traits\ImagenTrait;
use Illuminate\Support\Facades\Storage;
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
    public $productos_compuesto = [];
    public $productos_compuesto_total = 0;

    public $regla_producto = [
        'designacion' => 'required',
        'simbologia' => 'required',
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
        if ($producto->tipo == 'compuesto') {
            foreach ($producto->pcompuestos as $key => $pcom)
            {
                $bproducto = Producto::find($pcom->producto_asignado_id);
                $this->productos_compuesto[$bproducto->codigo]['producto_id'] = $bproducto->id;
                $this->productos_compuesto[$bproducto->codigo]['codigo'] = $bproducto->codigo;
                $this->productos_compuesto[$bproducto->codigo]['nombre'] = $bproducto->designacion;
                $this->productos_compuesto[$bproducto->codigo]['precio'] = $bproducto->precio;
                $this->productos_compuesto[$bproducto->codigo]['cantidad'] = $pcom->cantidad;
                $this->productos_compuesto[$bproducto->codigo]['total'] = $this->productos_compuesto[$bproducto->codigo]['precio']*$this->productos_compuesto[$bproducto->codigo]['cantidad'];
            }
            $this->verificar_productos();
        }


    }

    public function updat()
    {

        $this->validate($this->regla_producto+
        ['codigo' => 'required|unique:productos,codigo,'.$this->producto->id]);
        if ($this->tipo == 'compuesto') {
            $this->validate(['productos_compuesto' => 'required']);
        }

        $this->producto->update($this->all());
        if ($this->tipo == 'compuesto') {
            $this->actualizar_dproducto_compuesta();
        }
    }

    public function actualizar_dproducto_compuesta(){

        foreach ($this->producto->pcompuestos as $key => $pcom)
        {
            #verificar si el detalle existe en el array
            if (isset($this->productos_compuesto[$pcom->codigo]) == true) {
                $pcom->producto_asignado_id = $this->productos_compuesto[$pcom->codigo]['producto_id'];
                $pcom->cantidad = $this->productos_compuesto[$pcom->codigo]['cantidad'];
                $pcom->save();
            }
            else {
                $pcom->delete();
            }
        }
    }

    public function store($imagen = null)
    {
        $this->validate($this->regla_producto);
        if ($this->tipo == 'compuesto') {
            $this->validate(['productos_compuesto' => 'required']);
        }

        (isset($this->producto)) ? $this->updat() : $this->producto = Producto::create($this->all());
        if ($imagen) {
            $this->eliminar_imagen($this->producto->imagen);
            $this->producto->imagen = $this->subir_imagen($imagen, $this->producto->id, "producto_img");
            $this->producto->save();
        }


        if ($this->tipo == 'compuesto') {
            foreach ($this->productos_compuesto as $key => $value)
            {
                $new_com_pro = new CompuestoProducto();
                $new_com_pro->producto_id = $this->producto->id;
                $new_com_pro->producto_asignado_id = $this->productos_compuesto[$key]['producto_id'];
                $new_com_pro->cantidad = $this->productos_compuesto[$key]['cantidad'];
                $new_com_pro->save();
            }
        }
    }

    public function agregar_producto_compuesto($codigo){
        $bproducto = Producto::where('codigo',$codigo)->first();

        if ($bproducto)
        {
            $this->productos_compuesto[$bproducto->codigo]['producto_id'] = $bproducto->id;
            $this->productos_compuesto[$bproducto->codigo]['codigo'] = $bproducto->codigo;
            $this->productos_compuesto[$bproducto->codigo]['nombre'] = $bproducto->designacion;
            $this->productos_compuesto[$bproducto->codigo]['precio'] = $bproducto->precio;
            $this->productos_compuesto[$bproducto->codigo]['cantidad'] = 1;
            $this->productos_compuesto[$bproducto->codigo]['total'] = $this->productos_compuesto[$bproducto->codigo]['precio']*$this->productos_compuesto[$bproducto->codigo]['cantidad'];
        }

        $this->verificar_productos();
    }

    public function reiniciar_productos_compuesto() {
        $this->reset('productos_compuesto');
        $this->productos_compuesto_total = 0;
    }

    public function eliminar_item_producto_compuesto($item_id){
        unset($this->productos_compuesto[$item_id]);
    }

    public function verificar_productos()
    {
            $this->productos_compuesto_total = 0;
                foreach ($this->productos_compuesto as $key => $pcompuesto)
                {
                    $this->productos_compuesto[$key]['total'] = $this->productos_compuesto[$key]['precio']*$this->productos_compuesto[$key]['cantidad'];
                    $this->productos_compuesto_total = $this->productos_compuesto_total + $this->productos_compuesto[$key]['total'];
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
