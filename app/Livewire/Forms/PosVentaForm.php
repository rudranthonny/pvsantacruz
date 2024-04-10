<?php

namespace App\Livewire\Forms;

use App\Exports\ReporteVentasExport;
use App\Models\Configuracion;
use App\Models\Posventa;
use App\Models\PosventaDetalle;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Maatwebsite\Excel\Facades\Excel;

class PosVentaForm extends Form
{
    public ?Posventa $posventa;

    public function descargar_reporte_ventas_excel($posventas){
        return Excel::download(new ReporteVentasExport($posventas), 'ReporteVentas.xlsx');
    }

    public function descargar_reporte_ventas_pdf($posventas){
        $configuracion = Configuracion::find(1);
        $nombre_archivo = 'ReporteDeVentas-' . date("F j, Y, g:i a") . '.pdf';
        $consultapdf = FacadePdf::loadView('administrador.ventas.reporte_ventas_pdf', compact('posventas', 'configuracion'))->setPaper('a4', 'landscape');
        $pdfContent = $consultapdf->output();
        return response()->streamDownload(
            fn () => print($pdfContent),
            $nombre_archivo
        );
    }

    public function obtener_productos_mas_vendidos($finicio,$ffinal){
        $lista_productos = [];
        $dventas = PosventaDetalle::select('producto_id','producto_nombre')->where('created_at','>=',$finicio)->where('created_at','<=',$ffinal)->distinct('producto_id')->get()->unique('producto_id');
        foreach ($dventas as $key => $dventa)
        {
            $monto_total = PosventaDetalle::where('producto_id',$dventa->producto_id)->where('created_at','>=',$finicio)->where('created_at','<=',$ffinal)->sum('producto_importe');
            $lista_productos[$key]['producto_id']=$dventa->producto_id;
            $lista_productos[$key]['monto'] = PosventaDetalle::where('producto_id',$dventa->producto_id)->where('created_at','>=',$finicio)->where('created_at','<=',$ffinal)->sum('producto_importe');
            $lista_productos[$key]['producto_nombre'] = $dventa->producto_nombre;
            $lista_productos[$key]['venta_totales'] = PosventaDetalle::where('producto_id',$dventa->producto_id)->where('created_at','>=',$finicio)->where('created_at','<=',$ffinal)->sum('producto_cantidad');
        }


        usort($lista_productos, function ($a, $b) { return $b['monto'] - $a['monto']; });
        return $lista_productos;
    }

    public function descargar_pdf(Posventa $posventa)
    {
            $paper_examen = 0;
            $paper_heigth = 460;
            $paper_heigth = $paper_examen + $paper_heigth;
            $items_adicional = 18.2;
            if ($posventa->descuento > 0) {
                $items_adicional = $items_adicional+2;
            }
            if ($posventa->envio > 0) {
                $items_adicional = $items_adicional+2;
            }
            if ($posventa->impuesto_monto > 0) {
                $items_adicional = $items_adicional+2;
            }

            $configuracion = Configuracion::find(1);
            $nombre_archivo = 'comprobante-' . date("F j, Y, g:i a") . '.pdf';
            $consultapdf = FacadePdf::loadView('administrador.pdf.comprobante', compact('posventa', 'configuracion'))->setPaper([0, 0, 215.25, $paper_heigth + $items_adicional * 2 * ($posventa->posventadetalles->count())]);
            $pdfContent = $consultapdf->output();
            return response()->streamDownload(
                fn () => print($pdfContent),
                $nombre_archivo
            );
    }
}
