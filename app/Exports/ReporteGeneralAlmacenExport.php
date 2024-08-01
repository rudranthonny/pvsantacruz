<?php

namespace App\Exports;

use App\Models\Almacen;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;

class ReporteGeneralAlmacenExport implements FromView
{

    use Exportable;
    public function view(): View
    {
        $almacens = Almacen::all();
        return view('administrador.almacen.reporte_productos_almacen_general_excel', [
            'almacens' => $almacens
        ]);
    }
}
