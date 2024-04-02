<?php

namespace App\Exports;

use App\Models\Configuracion;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;

class ReporteProductosExport implements FromView
{
    private $lista_productos;

    public function __construct($lista_productos)
    {
        $this->lista_productos = $lista_productos;
    }
    use Exportable;
    public function view(): View
    {
        return view('administrador.productos.reporte_productos_excel', [
            'lista_productos' => $this->lista_productos,
            'configuracion' => Configuracion::find(1),
        ]);
    }
}
