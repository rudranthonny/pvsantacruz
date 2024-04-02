<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;

class ReporteAlmacenStockExport implements FromView
{
    private $productos_almacen;

    public function __construct($productos_almacen)
    {
        $this->productos_almacen = $productos_almacen;
    }
    use Exportable;
    public function view(): View
    {

        return view('administrador.almacen.reporte_productos_almacen_excel', [
            'productos_almacen' => $this->productos_almacen
        ]);
    }
}
