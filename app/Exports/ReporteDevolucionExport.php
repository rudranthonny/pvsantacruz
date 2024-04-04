<?php

namespace App\Exports;

use App\Models\Configuracion;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;

class ReporteDevolucionExport implements FromView
{
    private $lista_devolucions;

    public function __construct($lista_devolucions)
    {
        $this->lista_devolucions = $lista_devolucions;
    }
    use Exportable;
    public function view(): View
    {
        return view('administrador.devolucions.reporte_devolucions_excel', [
            'lista_devolucions' => $this->lista_devolucions,
            'configuracion' => Configuracion::find(1),
        ]);
    }
}
