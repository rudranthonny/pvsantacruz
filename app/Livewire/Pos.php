<?php

namespace App\Livewire;

use App\Models\Almacen;
use App\Models\Cliente;
use App\Models\Posventa;
use App\Models\PosventaDetalle;
use App\Models\Producto;
use App\Models\ProductoAlmacen;
use Livewire\Component;

class Pos extends Component
{
    public $almacen_id;
    public $cliente_id;
    public $productos;
    public $productoscompuestos;
    public $categorias;
    public $categoria_id;
    public $marcas;
    public $marca_id;
    public $items;
    public $impuesto_porcentaje;
    public $impuesto_monto;
    public $descuento;
    public $envio;
    public $total_pagar;
    public $cantidad_recibida;
    public $min_cantidad_recibida;
    public $monto_pago;
    public $cambio;
    public $nota_venta;
    public $nota_pago;

    public function mount()
    {
        $this->almacen_id = Almacen::first()->id;
        $this->cliente_id = Cliente::first()->id;
        $this->items = [];
        $this->updatedAlmacenId();
        $this->impuesto_porcentaje = 0;
    }

    public function updatedAlmacenId()
    {
        $this->productos = ProductoAlmacen::with('producto', 'producto.categoria', 'producto.marca', 'producto.cunitario')->where('almacen_id', $this->almacen_id)->get();
        $this->productoscompuestos = Producto::with('categoria', 'marca', 'cunitario')->where('tipo', 'compuesto')->get();
        $this->categorias = $this->productos->pluck('producto.categoria')->unique();
        $this->marcas = $this->productos->pluck('producto.marca')->unique();
        $this->reset(['categoria_id', 'marca_id']);
    }

    public function updatedCategoriaId()
    {
        $this->productos = ProductoAlmacen::with('producto', 'producto.categoria', 'producto.marca', 'producto.cunitario')->where('almacen_id', $this->almacen_id)
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

    public function updatedMarcaId()
    {
        $this->actualizar_montos();
    }

    public function updatedImpuestoPorcentaje()
    {
        $this->actualizar_montos();
    }

    public function updatedDescuento()
    {
        $this->actualizar_montos();
    }

    public function updatedEnvio()
    {
        $this->actualizar_montos();
    }

    public function updatedCantidadRecibida()
    {
        $this->actualizar_Cambio();
    }

    public function updatedMontoPago()
    {
        $this->actualizar_Cambio();
    }

    public function actualizar_Cambio()
    {
        $this->cambio = $this->cantidad_recibida - $this->monto_pago;
    }

    public function actualizar_montos()
    {
        $total_pagar = 0;

        foreach ($this->items as $item) {
            $total_pagar += $item['importe'];
        }
        $total_pagar = $total_pagar - $this->descuento;
        $this->impuesto_monto = ($total_pagar * ($this->impuesto_porcentaje / 100));
        $total_pagar = $total_pagar + $this->impuesto_monto;
        $total_pagar = $total_pagar + $this->envio;

        $this->total_pagar = $total_pagar;
        $this->cantidad_recibida = $total_pagar;
        $this->min_cantidad_recibida = $total_pagar;
        $this->monto_pago = $total_pagar;
        $this->actualizar_Cambio();
    }

    public function agregaritem(Producto $producto)
    {
        $cantidad = 1;
        if (array_key_exists($producto->codigo, $this->items)) {
            $cantidad += $this->items[$producto->codigo]['cantidad'];
        }
        $importe = $producto->precio * $cantidad;

        $item = new PosventaDetalle();
        $item->codigo = $producto->codigo;
        $item->designacion = $producto->designacion;
        $item->precio = $producto->precio;
        $item->cantidad = $cantidad;
        $item->importe = $importe;
        $item->tipo = $producto->tipo;
        $this->items[$item->codigo] = $item->toArray();
        $this->actualizar_montos();
    }

    public function updatedItems()
    {
        foreach ($this->items as $key => $item) {
            $this->items[$key]['importe'] = $item['precio'] * $item['cantidad'];
        }
        $this->actualizar_montos();
    }

    public function eliminaritem(string $codigo)
    {
        unset($this->items[$codigo]);
        $this->actualizar_montos();
    }

    public function guardar()
    {
        $almacen = Almacen::find($this->almacen_id);
        $cliente = Cliente::find($this->cliente_id);
        $posventa = new Posventa();
        $posventa->almacen_id = $almacen->id;
        $posventa->almacen_name = $almacen->nombre;
        $posventa->cliente_id = $cliente->id;
        $posventa->cliente_name = $cliente->name;
        $posventa->impuesto_porcentaje = $this->impuesto_porcentaje;
        $posventa->impuesto_monto = $this->impuesto_monto;
        $posventa->descuento = $this->descuento;
        $posventa->envio = $this->envio;
        $posventa->total_pagar = $this->total_pagar;
        $posventa->cantidad_recibida = $this->cantidad_recibida;
        $posventa->monto_pago = $this->monto_pago;
        $posventa->cambio = $this->cambio;
        $posventa->nota_venta = $this->nota_venta;
        $posventa->nota_pago = $this->nota_pago;
        $posventa->productos_totales = collect($this->items)->count();
        $posventa->save();

        foreach ($this->items as $item) {
            // $producto->stock -= $item['cantidad'];
            $posventa_detalle = new PosventaDetalle();
            $posventa_detalle->producto_id = $item['codigo'];
            $posventa_detalle->producto_nombre = $item['designacion'];
            $posventa_detalle->producto_precio = $item['precio'];
            $posventa_detalle->producto_cantidad = $item['cantidad'];
            $posventa_detalle->producto_importe = $item['importe'];
            $posventa_detalle->producto_tipo = $item['tipo'];
            $posventa_detalle->save();
        }
    }

    public function render()
    {
        $clientes = Cliente::all();
        $almacenes = Almacen::all();
        return view('livewire.pos', compact('clientes', 'almacenes'))->layout('administrador.ventas.pos');
    }
}
