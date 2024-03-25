<?php

namespace App\Livewire;

use App\Models\Almacen;
use App\Models\Cliente;
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
    public $monto_pago;
    public $cambio;

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
        $this->cambio= $this->cantidad_recibida - $this->monto_pago;
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
        $this->cantidad_recibida= $total_pagar;
        $this->monto_pago= $total_pagar;
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

    public function render()
    {
        $clientes = Cliente::all();
        $almacenes = Almacen::all();
        return view('livewire.pos', compact('clientes', 'almacenes'))->layout('administrador.ventas.pos');
    }
}
