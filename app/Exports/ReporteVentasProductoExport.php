<?php

namespace App\Exports;

use App\Models\Configuracion;
use App\Models\PosventaDetalle;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ReporteVentasProductoExport implements FromView, WithDrawings
{
    private $salmacen;
    private $finicio;
    private $ffinal;
    private $sfacturacion;
    private $scajero;

    public function __construct($salmacen = null,$finicio = null,$ffinal = null,$sfacturacion = null, $scajero = null)
    {
        $this->salmacen = $salmacen;
        $this->finicio = $finicio;
        $this->ffinal = $ffinal;
        $this->sfacturacion = $sfacturacion;
        $this->scajero = $scajero;
    }
    use Exportable;
    public function view(): View
    {
        #obtener la lista de productos por id
        $lista_productos = PosventaDetalle::query()->select('producto_nombre', 'producto_id','producto_codigo');
        $lista_productos->when($this->finicio != null && $this->ffinal != null  ,function ($q) {
            return $q->whereExists(function ($query) {
                $query->select()
                    ->from('posventas')
                    ->whereColumn('posventas.id', 'posventa_detalles.posventa_id')
                    ->where('posventas.created_at','>=',$this->finicio." 00:00:00")
                    ->where('posventas.created_at','<=',$this->ffinal." 23:59:59");});
        });
        $lista_productos = $lista_productos->distinct()->get();

        #crear arreglo
        $arreglo_productos = [];
        #recorrer el arreglo
        foreach ($lista_productos as $key => $lproducto)
        {
            $lista_prov2 = PosventaDetalle::query()->where('producto_id',$lproducto->producto_id);
                $lista_prov2->when($this->finicio != null && $this->ffinal != null  ,function ($q) {
                return $q->whereExists(function ($query) {
                    $query->select()
                        ->from('posventas')
                        ->whereColumn('posventas.id', 'posventa_detalles.posventa_id')
                        ->where('posventas.created_at','>=',$this->finicio." 00:00:00")
                        ->where('posventas.created_at','<=',$this->ffinal." 23:59:59");});
            });

            $lista_prov2->when($this->salmacen != null  ,function ($q) {
                return $q->whereExists(function ($query) {
                    $query->select()
                        ->from('posventas')
                        ->whereColumn('posventas.id', 'posventa_detalles.posventa_id')
                        ->where('posventas.almacen_id',$this->salmacen);});
            });

            $lista_prov2->when($this->scajero != null  ,function ($q) {
                return $q->whereExists(function ($query) {
                    $query->select()
                        ->from('posventas')
                        ->whereColumn('posventas.id', 'posventa_detalles.posventa_id')
                        ->where('posventas.cajero_id',$this->scajero);});
            });

            $lista_prov2->when($this->sfacturacion == 'sinfactura'  ,function ($q) {
                return $q->whereExists(function ($query) {
                    $query->select()
                        ->from('posventas')
                        ->whereColumn('posventas.id', 'posventa_detalles.posventa_id')
                        ->whereNull('invoice_id');});
            });

            $lista_prov2->when($this->sfacturacion == 'factura'  ,function ($q) {
                return $q->whereExists(function ($query) {
                    $query->select()
                        ->from('posventas')
                        ->whereColumn('posventas.id', 'posventa_detalles.posventa_id')
                        ->whereNotNull('invoice_id');});
            });

            $lista_prov2 = $lista_prov2->get();

            $total = 0;
            $cantidad_total = 0;

            foreach ($lista_prov2 as $key => $lprov2)
            {
                $cantidad_total = $cantidad_total + $lprov2->producto_cantidad;
                $total = $total + ($lprov2->producto_cantidad*$lprov2->producto_precio);
            }
            if($total > 0)
            {
                $arreglo_productos[$lproducto->producto_id]['codigo'] = $lproducto->producto_codigo;
                $arreglo_productos[$lproducto->producto_id]['descripcion'] = $lproducto->producto_nombre;
                $arreglo_productos[$lproducto->producto_id]['cantidad'] = $cantidad_total;
                $arreglo_productos[$lproducto->producto_id]['precio'] = $total/$cantidad_total;
                $arreglo_productos[$lproducto->producto_id]['total'] = $total;
            }
        }


        return view('administrador.ventas.reporte_ventas_by_producto_excel', [
            'lista_ventas_productos' => $arreglo_productos,
            'configuracion' => Configuracion::find(1),
            'finicio' => $this->finicio,
            'ffinal' => $this->ffinal,
        ]);
    }

    public function drawings()
    {
        $configuracion = Configuracion::find(1);
        $drawing = new Drawing();
        $drawing->setName('Producto de la imagén');
        $drawing->setDescription('Imagen del Producto');
        $drawing->setPath(storage_path('app/public/'.str_replace('/storage','',$configuracion->logo))); // Ruta de la imagen
        //$drawing->setPath(public_path('imagenes/logo.png')); // Ruta de la imagen
        $drawing->setHeight(75); // Ajustar el tamaño
        $drawing->setCoordinates('A1'); // Celda donde insertar la imagen
        $drawing->setOffsetX(45); // Ajuste horizontal (X), aumentar o reducir para centrar
        $drawing->setOffsetY(5); // Ajuste vertical (Y)
        return [$drawing];
    }
}
