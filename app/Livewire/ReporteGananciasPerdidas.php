<?php

namespace App\Livewire;

use App\Exports\ReporteGeneralAuxiliarExcel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use App\Models\Almacen;
use App\Models\Cliente;
use App\Models\Configuracion;
use App\Models\Devolucion;
use App\Models\Gasto;
use App\Models\Compra;
use App\Models\PagoCompra;
use App\Models\Posventa;
use App\Models\PosventaDetalle;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteGeneralExcel;
use App\Models\Movimiento;
use DateTime;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class ReporteGananciasPerdidas extends Component
{
    public $salmacen,$fecha_inicial,$fecha_final;
    public $monto_ventas;
    public $monto_compras;
    public $monto_deuda;
    public $monto_devoluciones;
    public $monto_gastos;
    public $monto_com_by_vent;
    public $lista_ventas;
    public $lista_compras;
    public $lista_devoluciones;
    public $lista_gastos;
    public $configuracion;
    public $lista_pago_compras;

    public $almacens;

    #[On('descargar-reporte-general-pdf')]
    public function descargar_reporte_general_pdf($simple = false)
    {
        $monto_ventas = $this->monto_ventas;
        $monto_compras = $this->monto_compras;
        $monto_deuda = $this->monto_deuda;
        $monto_devoluciones = $this->monto_devoluciones;
        $monto_gastos = $this->monto_gastos;
        $monto_com_by_vent = $this->monto_com_by_vent;
        $configuracion = $this->configuracion;
        $lista_ventas = $this->lista_ventas;
        $lista_compras = $this->lista_compras;
        $lista_devoluciones = $this->lista_devoluciones;
        $lista_gastos = $this->lista_gastos;
        $nombre_titulo = null;
        if ($this->salmacen <> null) {
            $balmacen = Almacen::find($this->salmacen);
            $nombre_titulo = $balmacen->nombre;
        }

        $nombre_archivo = 'ReporteGeneral-' . date("Y-m-d H:i:s") . '.pdf';
        $consultapdf = FacadePdf::loadView('administrador.reportes.reporte_general_pdf', compact(
            'simple',
            'monto_ventas',
            'monto_compras',
            'monto_deuda',
            'monto_devoluciones',
            'monto_gastos',
            'monto_com_by_vent',
            'configuracion',
            'lista_ventas',
            'lista_compras',
            'lista_devoluciones',
            'lista_gastos','nombre_titulo'))->setPaper('a4', 'landscape');
        $pdfContent = $consultapdf->output();
        return response()->streamDownload(
            fn () => print($pdfContent),
            $nombre_archivo
        );
    }

    public function mount(){
        $this->fecha_inicial = date('Y-m').'-01';

        $date = new DateTime('now');
        $date->modify('last day of this month');
        $date->format('Y-m-d');
        $this->fecha_final = $date->format('Y-m-d');
        $this->configuracion = Configuracion::find(1);
    }

    public function descargar_reporte_general_excel()
    {
        $nombre_titulo = null;
        if ($this->salmacen <> null) {
            $balmacen = Almacen::find($this->salmacen);
            $nombre_titulo = $balmacen->nombre;
        }

        return Excel::download(new ReporteGeneralExcel(
        $this->monto_ventas,
        $this->monto_compras,
        $this->monto_deuda,
        $this->monto_devoluciones,
        $this->monto_gastos,
        $this->monto_com_by_vent,
        $this->configuracion,
        $this->lista_ventas,$this->lista_compras,$this->lista_devoluciones,$this->lista_gastos,$nombre_titulo),
         'ReporteGeneralExcel.xlsx');
    }

    public function descargar_reporte_general_auxiliar_excel()
    {
        $nombre_titulo = null;
        if ($this->salmacen <> null)
        {
            $balmacen = Almacen::find($this->salmacen);
            $nombre_titulo = $balmacen->nombre;
            $movimientos = Movimiento::where('almacen',$balmacen->id)
            ->where('created_at','>=',$this->fecha_inicial." 00:00:00")
            ->where('created_at','<=',$this->fecha_final." 23:59:59")
            ->get();

            return Excel::download(new ReporteGeneralAuxiliarExcel(
            $this->fecha_inicial,
            $this->fecha_final,
            $movimientos,$nombre_titulo),
            'ReporteGeneralAuxiliarExcel.xlsx');
        }
    }

    public function descargar_reporte_general_auxiliar_pdf()
    {

        $nombre_titulo = null;
        if ($this->salmacen <> null)
        {
            $balmacen = Almacen::find($this->salmacen);
            $nombre_titulo = $balmacen->nombre;
            $finicio = $this->fecha_inicial;
            $ffinal   = $this->fecha_final;
            $configuracion = $this->configuracion;
            $movimientos = Movimiento::where('almacen',$balmacen->id)
            ->where('created_at','>=',$this->fecha_inicial." 00:00:00")
            ->where('created_at','<=',$this->fecha_final." 23:59:59")
            ->get();

            $nombre_archivo = 'ReporteAuxiliar-' . date("Y-m-d H:i:s") . '.pdf';
            $consultapdf = FacadePdf::loadView('administrador.reportes.reportes_general_auxiliar_pdf', compact(
                'balmacen',
                'nombre_titulo',
                'movimientos',
                'finicio',
                'ffinal',
                'configuracion'))
                ->setPaper('a4', 'landscape');

            $pdfContent = $consultapdf->output();
            return response()->streamDownload(
                fn () => print($pdfContent),
                $nombre_archivo
            );
        }
    }


    public function render()
    {
        $this->monto_ventas = Posventa::query();
        $this->monto_compras = PagoCompra::query();
        $this->lista_pago_compras = PagoCompra::query();
        $this->lista_compras = Compra::query();
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

        $this->lista_pago_compras->when($this->salmacen <> '',function ($q) {
            return $q->whereExists(function ($query)  {
                $query->select()
                      ->from(DB::raw('compras'))
                      ->whereColumn('pago_compras.compra_id', 'compras.id')
                      ->where('compras.almacen_id',$this->salmacen);
            });
        });

        $this->lista_compras->when($this->salmacen <> '',function ($q) {
            return $q->where('compras.almacen_id',$this->salmacen);
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
        $this->lista_ventas =  $this->monto_ventas->where('created_at','>=',$this->fecha_inicial." 00:00:00")->where('created_at','<=',$this->fecha_final." 23:59:59")->get();
        $this->monto_ventas =  $this->monto_ventas->where('created_at','>=',$this->fecha_inicial." 00:00:00")->where('created_at','<=',$this->fecha_final." 23:59:59")->sum('monto_pago');
        $this->lista_compras =  $this->lista_compras->where('created_at','>=',$this->fecha_inicial." 00:00:00")->where('created_at','<=',$this->fecha_final." 23:59:59")->get();
        $this->monto_compras = $this->monto_compras->where('created_at','>=',$this->fecha_inicial." 00:00:00")->where('created_at','<=',$this->fecha_final." 23:59:59")->sum('monto_pago');
        $this->lista_pago_compras = $this->lista_pago_compras->where('created_at','>=',$this->fecha_inicial." 00:00:00")->where('created_at','<=',$this->fecha_final." 23:59:59")->get();
        $this->lista_gastos = $this->monto_gastos->where('created_at','>=',$this->fecha_inicial." 00:00:00")->where('ignorar','0')->where('created_at','<=',$this->fecha_final." 23:59:59")->get();
        $this->monto_gastos = $this->monto_gastos->where('created_at','>=',$this->fecha_inicial." 00:00:00")->where('ignorar','0')->where('created_at','<=',$this->fecha_final." 23:59:59")->sum('monto');
        $this->lista_devoluciones = $this->monto_devoluciones->where('created_at','>=',$this->fecha_inicial." 00:00:00")->where('created_at','<=',$this->fecha_final." 23:59:59")->get();
        $this->monto_devoluciones = $this->monto_devoluciones->where('created_at','>=',$this->fecha_inicial." 00:00:00")->where('created_at','<=',$this->fecha_final." 23:59:59")->sum('monto_pago');
        $this->monto_deuda = Cliente::whereNotNull('deuda_total')->where('deuda_total','>',0)->sum('deuda_total');
        $this->almacens = Almacen::all();
        return view('livewire.reporte-ganancias-perdidas');
    }
}
