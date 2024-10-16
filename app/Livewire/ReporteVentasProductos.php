<?php

namespace App\Livewire;

use App\Models\Almacen;
use App\Models\Configuracion;
use App\Models\Posventa;
use App\Models\PosventaDetalle;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Livewire\Component;

class ReporteVentasProductos extends Component
{
    public $bproducto;
    public $finicio,$ffinal,$salmacen;
    public $lista_producto = [];
    public $consulta_ventas;
    public $productos;
    public $nombre_productos;

    public $rules_consulta = [
        'finicio' => 'required',
        'ffinal' => 'required',
        'lista_producto' => 'required',
    ];

    public function updatedBproducto(){
        $this->dispatch('activar_buscador_producto');
    }

    public function agregar_producto_compuesto()
    {
        $bproducto = Producto::where('codigo',$this->bproducto)->first();
        if ($bproducto)
        {
            $this->resetErrorBag();
            $this->lista_producto[$bproducto->id]['codigo'] = $bproducto->codigo;
            $this->lista_producto[$bproducto->id]['nombre'] = $bproducto->designacion;
        }
        else {
            $this->addError('bproducto', 'El Producto no existe');
            return;
        }
    }

    public function eliminar_item($key){unset($this->lista_producto[$key]);}

    public function consultar() {

        $this->reset('productos','nombre_productos');
        $this->validate($this->rules_consulta);
        $this->productos = array_keys($this->lista_producto);
        $this->nombre_productos = $this->lista_producto;
        $this->consulta_ventas = PosventaDetalle::query()->where('created_at','>=',$this->finicio." 00:00:00")->where('created_at','<=',$this->ffinal." 23:59:59");

        $this->consulta_ventas->when($this->salmacen <> '',function ($q) {
            return $q->whereExists(function ($query) {
                $query->select()
                    ->from(DB::raw('posventas'))
                    ->whereColumn('posventa_detalles.posventa_id', 'posventas.id')
                    ->where('posventas.estado_posventa','<>','eliminado')
                    ->where('posventas.almacen_id', $this->salmacen);
            });
        });


        $this->consulta_ventas->whereIn('producto_id', $this->productos);
        $this->consulta_ventas =  $this->consulta_ventas->get();
    }

    public function descargar_pdf()
    {
        $configuracion = Configuracion::find(1);
        $productos = $this->productos;
        $nombre_productos = $this->nombre_productos;
        $consulta_ventas = $this->consulta_ventas;
        $salmacen = $this->salmacen;
        $almacens = Almacen::all();
        $finicio = $this->finicio;
        $ffinal = $this->ffinal;
        $nombre_archivo = 'ReporteDeVentasProductos-' . date("Y-m-d H:i:s") . '.pdf';
        $consultapdf = FacadePdf::loadView('administrador.reportes.reporte_ventas_productos_pdf', compact('ffinal','finicio','salmacen','almacens','productos','nombre_productos','consulta_ventas','configuracion'))->setPaper('a4', 'landscape');
        $pdfContent = $consultapdf->output();
        return response()->streamDownload(
            fn () => print($pdfContent),
            $nombre_archivo
        );
    }

    public function render()
    {
        $almacens = Almacen::all();
        $configuracion = Configuracion::find(1);
        return view('livewire.reporte-ventas-productos',compact('almacens','configuracion'));
    }
}
