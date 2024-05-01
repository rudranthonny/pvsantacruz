<?php

namespace App\Livewire;

use App\Models\Almacen;
use App\Models\Cliente;
use App\Models\Configuracion;
use App\Models\Devolucion;
use App\Models\Gasto;
use App\Models\PagoCompra;
use App\Models\Posventa;
use App\Models\PosventaDetalle;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteGeneralExcel;
use DateTime;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ReporteGananciasPerdidas extends Component
{
    public $salmacen,$fecha_inicial,$fecha_final;
    public $monto_ventas;
    public $monto_compras;
    public $monto_devoluciones;
    public $monto_gastos;
    public $monto_com_by_vent;
    public $configuracion;
    public $monto_deuda;
    public $almacens;

    public function mount(){
        $this->fecha_inicial = date('Y-m').'-01';

        $date = new DateTime('now');
        $date->modify('last day of this month');
        $date->format('Y-m-d');
        $this->fecha_final = $date->format('Y-m-d');
        $this->configuracion = Configuracion::find(1);
    }

    public function descargar_reporte_general_excel(){
        return Excel::download(new ReporteGeneralExcel($lista_productos), 'ReporteProductos.xlsx');
    }

    public function render()
    {
        $this->monto_ventas = Posventa::query();
        $this->monto_compras = PagoCompra::query();
        $this->monto_devoluciones = Devolucion::query();
        $this->monto_gastos = Gasto::query();
        $this->monto_com_by_vent = PosventaDetalle::query()->whereExists(function ($query)  {
            $query->select()
                  ->from(DB::raw('posventas'))
                  ->whereColumn('posventa_detalles.posventa_id', 'posventas.id')
                  ->where('posventas.estado_posventa','<>','eliminado');
        });

        $this->monto_ventas->when($this->salmacen <> '',function ($q) {
            return $q->where('almacen_id',$this->salmacen);
        });

        $this->monto_compras->when($this->salmacen <> '',function ($q) {
            return $q->whereExists(function ($query)  {
                $query->select()
                      ->from(DB::raw('compras'))
                      ->whereColumn('pago_compras.compra_id', 'compras.id')
                      ->where('compras.almacen_id',$this->salmacen);
            });
        });

        $this->monto_com_by_vent->when($this->salmacen <> '',function ($q) {
            return $q->whereExists(function ($query)  {
                $query->select()
                      ->from(DB::raw('posventas'))
                      ->whereColumn('posventa_detalles.posventa_id', 'posventas.id')
                      ->where('posventas.almacen_id',$this->salmacen);
            });
        });

        $this->monto_devoluciones->when($this->salmacen <> '',function ($q) {
            return $q->where('almacen_id',$this->salmacen);
        });

        $this->monto_gastos->when($this->salmacen <> '',function ($q) {
            return $q->where('almacen_id',$this->salmacen);
        });

        $this->monto_com_by_vent =  $this->monto_com_by_vent->where('created_at','>=',$this->fecha_inicial." 00:00:00")->where('created_at','<=',$this->fecha_final." 23:59:59")->sum('producto_costo_compra');
        $this->monto_ventas =  $this->monto_ventas->where('created_at','>=',$this->fecha_inicial." 00:00:00")->where('created_at','<=',$this->fecha_final." 23:59:59")->sum('monto_pago');
        $this->monto_compras = $this->monto_compras->where('created_at','>=',$this->fecha_inicial." 00:00:00")->where('created_at','<=',$this->fecha_final." 23:59:59")->sum('monto_pago');
        $this->monto_gastos = $this->monto_gastos->where('created_at','>=',$this->fecha_inicial." 00:00:00")->where('ignorar','0')->where('created_at','<=',$this->fecha_final." 23:59:59")->sum('monto');
        $this->monto_devoluciones = $this->monto_devoluciones->where('created_at','>=',$this->fecha_inicial." 00:00:00")->where('created_at','<=',$this->fecha_final." 23:59:59")->sum('monto_pago');
        $this->monto_deuda = Cliente::whereNotNull('deuda_total')->where('deuda_total','>',0)->sum('deuda_total');
        $this->almacens = Almacen::all();

        return view('livewire.reporte-ganancias-perdidas');
    }
}
