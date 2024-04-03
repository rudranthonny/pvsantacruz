<?php

namespace App\Livewire\Forms;

use App\Models\Devolucion;
use App\Models\DevolucionDetalle;
use App\Models\Posventa;
use App\Models\PosventaDetalle;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DevolucionForm extends Form
{
    public ?Devolucion $devolucion;
    public ?Posventa $posventa;
    public $posventa_id;
    public $almacen_id;
    public $almacen_name;
    public $cliente_id;
    public $cliente_name;
    public $impuesto_porcentaje;
    public $impuesto_monto;
    public $descuento;
    public $envio;
    public $total_pagar;
    public $cantidad_recibida;
    public $monto_pago;
    public $cambio;
    public $nota_devolucion;
    public $productos_totales;
    public $estado_devolucion;
    public $detalles_devolucion = [];

    public function agregar_datos_venta(Posventa $posventa){
        $this->posventa = $posventa;
        $this->posventa_id = $posventa->id;
        $this->almacen_id = $posventa->almacen_id;
        $this->almacen_name = $posventa->almacen_name;
        $this->cliente_id = $posventa->cliente_id;
        $this->cliente_name = $posventa->cliente_name;
        $this->impuesto_porcentaje = 0;
        $this->impuesto_monto = 0;
        $this->descuento = 0;
        $this->envio = 0;
        $this->total_pagar = 0;
        $this->cantidad_recibida =0;
        $this->monto_pago = 0;
        $this->cambio = 0;
        $this->nota_devolucion = 0;
        $this->productos_totales = 0;
        $this->estado_devolucion = null;

        foreach ($posventa->posventadetalles as $key => $posdetalle)
        {
            $this->detalles_devolucion[$posdetalle->producto_codigo]['id'] = '';
            $this->detalles_devolucion[$posdetalle->producto_codigo]['devolucion_id'] = '';
            $this->detalles_devolucion[$posdetalle->producto_codigo]['detalle_id'] = $posdetalle->id;
            $this->detalles_devolucion[$posdetalle->producto_codigo]['producto_id'] = $posdetalle->producto_id;
            $this->detalles_devolucion[$posdetalle->producto_codigo]['producto_codigo'] = $posdetalle->producto_codigo;
            $this->detalles_devolucion[$posdetalle->producto_codigo]['producto_nombre'] = $posdetalle->producto_nombre;
            $this->detalles_devolucion[$posdetalle->producto_codigo]['producto_precio'] = $posdetalle->producto_precio;
            $this->detalles_devolucion[$posdetalle->producto_codigo]['producto_cantidad'] = $posdetalle->producto_cantidad;
            $this->detalles_devolucion[$posdetalle->producto_codigo]['producto_importe'] = $posdetalle->producto_importe;
            $this->detalles_devolucion[$posdetalle->producto_codigo]['producto_tipo'] = $posdetalle->producto_tipo;
        }
    }

    public function actualizar_datos(){
        $this->total_pagar = 0;
        foreach ($this->detalles_devolucion as $key => $det_devolucion) {
            $bposdetalle = PosventaDetalle::find($this->detalles_devolucion[$key]['detalle_id']);
            $bdev = DevolucionDetalle::where('detalle_id',$this->detalles_devolucion[$key]['detalle_id'])->sum('producto_cantidad');
            if($this->detalles_devolucion[$key]['producto_cantidad'] >= ($bposdetalle->producto_cantidad-$bdev))
            {
                $this->detalles_devolucion[$key]['producto_cantidad'] = ($bposdetalle->producto_cantidad-$bdev);
            }
            $this->detalles_devolucion[$key]['producto_importe'] =  $this->detalles_devolucion[$key]['producto_cantidad']*$this->detalles_devolucion[$key]['producto_precio'];
            $this->total_pagar = $this->total_pagar+$this->detalles_devolucion[$key]['producto_importe'];
        }
    }
}
