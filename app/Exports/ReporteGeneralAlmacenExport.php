<?php

namespace App\Exports;

use App\Models\Almacen;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;

class ReporteGeneralAlmacenExport implements FromView
{

    private $almacen;

    public function __construct($almacen = null)
    {
        $this->almacen = $almacen;
    }

    use Exportable;
    public function view(): View
    {
        if ($this->almacen) {$almacens = Almacen::where('id',$this->almacen)->get();}

        else {$almacens = Almacen::all();}

        return view('administrador.almacen.reporte_productos_almacen_general_excel', [
            'almacens' => $almacens
        ]);
    }
}
