<?php

namespace App\Exports;

use App\Models\Configuracion;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;

class ReporteComprasExport implements FromView
{
    private $lista_ventas;

    public function __construct($lista_ventas)
    {
        $this->lista_ventas = $lista_ventas;
    }
    use Exportable;
    public function view(): View
    {
        return view('administrador.compras.reporte_compras_excel', [
            'lista_compras' => $this->lista_ventas,
            'configuracion' => Configuracion::find(1),
        ]);
    }
}
