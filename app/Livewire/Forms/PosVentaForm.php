<?php

namespace App\Livewire\Forms;

use App\Models\Configuracion;
use App\Models\Posventa;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class PosVentaForm extends Form
{
    public ?Posventa $posventa;
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
