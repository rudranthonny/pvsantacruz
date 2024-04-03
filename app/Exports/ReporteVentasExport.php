<?php

namespace App\Exports;

use App\Models\Configuracion;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;

class ReporteVentasExport implements FromView
{
    private $lista_ventas;

    public function __construct($lista_ventas)
    {
        $this->lista_ventas = $lista_ventas;
    }
    use Exportable;
    public function view(): View
    {
        return view('administrador.ventas.reporte_ventas_excel', [
            'lista_ventas' => $this->lista_ventas,
            'configuracion' => Configuracion::find(1),
        ]);
    }
}
