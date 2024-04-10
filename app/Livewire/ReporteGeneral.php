<?php

namespace App\Livewire;

use App\Livewire\Forms\PosVentaForm;
use App\Models\Almacen;
use App\Models\Cliente;
use App\Models\Compra;
use App\Models\Configuracion;
use App\Models\Gasto;
use App\Models\PagoCompra;
use App\Models\Posventa;
use App\Models\ProductoAlmacen;
use DateTime;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ReporteGeneral extends Component
{
    public $salmacen;
    public PosVentaForm $posventaform;
    public $search;
    public $pagina = 5;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $monto_ventas = Posventa::query();
        $monto_compras = PagoCompra::query();
        $monto_gastos = Gasto::query();

        $productos_almacen = ProductoAlmacen::query()->whereExists(function ($query)  {
            $query->select()
                  ->from(DB::raw('productos'))
                  ->whereColumn('producto_almacens.producto_id', 'productos.id')
                  ->where('productos.designacion','like','%'.$this->search.'%');
        })->where('stock','==',0);

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

        $productos_almacen->when($this->salmacen <> '',function ($q) {
            return $q->where('almacen_id',$this->salmacen);
        });

        $date = new DateTime('now');
        $date->modify('last day of this month');
        $productos_vendidos = $this->posventaform->obtener_productos_mas_vendidos(date('Y-m-1 00:00:00'), $date->format('Y-m-d')." 23:59:59");
        $monto_ventas =  $monto_ventas->where('created_at','>=',date('Y-m-d 00:00:00'))->where('created_at','<=',date('Y-m-d 23:59:59'))->sum('monto_pago');
        $monto_compras = $monto_compras->where('created_at','>=',date('Y-m-d 00:00:00'))->where('created_at','<=',date('Y-m-d 23:59:59'))->sum('monto_pago');
        $monto_gastos = $monto_gastos->where('created_at','>=',date('Y-m-d 00:00:00'))->where('created_at','<=',date('Y-m-d 23:59:59'))->sum('monto');
        $productos_almacen = $productos_almacen->paginate($this->pagina);

        $monto_deuda = Cliente::whereNotNull('deuda_total')->where('deuda_total','>',0)->sum('deuda_total');

        $almacens = Almacen::all();
        $configuracion = Configuracion::find(1);
        return view('livewire.reporte-general',compact('almacens','configuracion','monto_ventas','monto_compras','monto_gastos','monto_deuda','productos_almacen','productos_vendidos'));
    }
}
