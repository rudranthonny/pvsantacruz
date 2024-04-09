<?php

namespace App\Livewire;

use App\Models\Almacen;
use App\Models\Cliente;
use App\Models\Compra;
use App\Models\Configuracion;
use App\Models\Gasto;
use App\Models\PagoCompra;
use App\Models\Posventa;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ReporteGeneral extends Component
{
    public $salmacen;
    public function render()
    {

        $monto_ventas = Posventa::query();
        $monto_compras = PagoCompra::query();
        $monto_gastos = Gasto::query();

        $monto_ventas->when($this->salmacen <> '',function ($q) {
            return $q->where('almacen_id',$this->salmacen);
        });

        $monto_compras->when($this->salmacen <> '',function ($q) {
            return $q->whereExists(function ($query)  {
                $query->select()
                      ->from(DB::raw('compras'))
                      ->whereColumn('pago_compras.compra_id', 'compras.id')
                      ->where('compras.almacen_id',$this->salmacen);
            });
        });

        $monto_gastos->when($this->salmacen <> '',function ($q) {
            return $q->where('almacen_id',$this->salmacen);
        });

        $monto_ventas =  $monto_ventas->where('created_at','>=',date('Y-m-d 00:00:00'))->where('created_at','<=',date('Y-m-d 23:59:59'))->sum('monto_pago');
        $monto_compras = $monto_compras->where('created_at','>=',date('Y-m-d 00:00:00'))->where('created_at','<=',date('Y-m-d 23:59:59'))->sum('monto_pago');
        $monto_gastos = $monto_gastos->where('created_at','>=',date('Y-m-d 00:00:00'))->where('created_at','<=',date('Y-m-d 23:59:59'))->sum('monto');

        $monto_deuda = Cliente::whereNotNull('deuda_total')->where('deuda_total','>',0)->sum('deuda_total');

        $almacens = Almacen::all();
        $configuracion = Configuracion::find(1);
        return view('livewire.reporte-general',compact('almacens','configuracion','monto_ventas','monto_compras','monto_gastos','monto_deuda'));
    }
}
