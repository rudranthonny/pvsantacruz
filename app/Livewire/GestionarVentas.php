<?php

namespace App\Livewire;

use App\Exports\ReporteVentasExport;
use App\Livewire\Forms\DevolucionForm;
use App\Livewire\Forms\GenerarAnulacion;
use App\Models\Almacen;
use App\Models\Configuracion;
use App\Models\Posventa;
use App\Livewire\Forms\PosVentaForm;
use App\Models\Gasto;
use App\Models\Invoice;
use App\Models\PagoCompra;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class GestionarVentas extends Component
{

    use WithPagination;
    public PosVentaForm $posventaform;
    public DevolucionForm $devolucionform;
    public GenerarAnulacion $generaranulacion;
    protected $paginationTheme = 'bootstrap';
    public $pagina = 5;
    public $configuracion;
    public $search,$finicio,$ffinal,$salmacen,$sfacturacion;
    public function mount(){  $this->configuracion = Configuracion::find(1); }

    public function seleccionar_tipo_reporte(){
        $this->dispatch('descargar_reporte');
    }

    #[On('descargar_reporte_ventas_pdf')]
    public function descargar_reporte_ventas_pdf($simple = false){

        $posventas = Posventa::query()->where('cliente_name','like',"%".$this->search."%")->orderByDesc('id');
        $compras = PagoCompra::query();
        $gastos = Gasto::query();
        
        $gastos->when($this->salmacen <> '',function ($q) {
            return $q->where('almacen_id',$this->salmacen);
        });
        $gastos->when($this->finicio != null && $this->ffinal != null  ,function ($q) {
            return $q->where('fecha','>=',$this->finicio)->where('fecha','<=',$this->ffinal);
        });

        $gastos = $gastos->get();

        $compras->when($this->salmacen <> '',function ($q) {
            return $q->whereExists(function ($query) {
                $query->select()
                    ->from('compras')
                    ->whereColumn('compras.id', 'pago_compras.compra_id')
                    ->where('compras.almacen_id',$this->salmacen);});
        });
        
        $compras->when($this->finicio != null && $this->ffinal != null  ,function ($q) {
            return $q->where('fecha_pago','>=',$this->finicio)->where('fecha_pago','<=',$this->ffinal);
        });
        $compras = $compras->get();

        $posventas->when($this->salmacen <> '',function ($q) {
            return $q->where('almacen_id',$this->salmacen);
        });

        $posventas->when($this->finicio != null && $this->ffinal != null  ,function ($q) {
            return $q->where('created_at','>=',$this->finicio." 00:00:00")->where('created_at','<=',$this->ffinal." 23:59:59");
        });

        $posventas->when($this->sfacturacion == 'sinfactura'  ,function ($q) {
            return $q->whereNull('invoice_id');
        });

        $posventas->when($this->sfacturacion == 'factura'  ,function ($q) {
            return $q->whereNotNull('invoice_id');
        });

        $posventas = $posventas->get();
        return $this->posventaform->descargar_reporte_ventas_pdf($posventas,$compras,$gastos,$simple);
    }

    public function anular_factura(Posventa $posventa){
        $this->generaranulacion->reset();
        $this->generaranulacion->MotivoAnulacion = "error al escribir la factura";
        $cinvoice = $this->generaranulacion->anular_factura($posventa->invoice);
        $posventa->cinvoice_id = $cinvoice->id;
        $posventa->save();
    }

    public function updatedDevolucionform(){$this->devolucionform->actualizar_datos();
    }

    public function eliminar_item_devolucion($item_id){
        $this->devolucionform->eliminar_item_devolucion($item_id);
    }

    public function descargar_reporte_ventas_excel()
    {
        $posventas = Posventa::query()->where('cliente_name','like',"%".$this->search."%")->orderByDesc('id');

        $posventas->when($this->salmacen <> '',function ($q) {
            return $q->where('almacen_id',$this->salmacen);
        });

        $posventas->when($this->finicio != null && $this->ffinal != null  ,function ($q) {
            return $q->where('created_at','>=',$this->finicio." 00:00:00")->where('created_at','<=',$this->ffinal." 23:59:59");
        });

        $posventas->when($this->sfacturacion == 'sinfactura'  ,function ($q) {
            return $q->whereNull('invoice_id');
        });

        $posventas->when($this->sfacturacion == 'factura'  ,function ($q) {
            return $q->whereNotNull('invoice_id');
        });


        $posventas = $posventas->get();
        return $this->posventaform->descargar_reporte_ventas_excel($posventas);
    }

    public function descargar_venta_pdf(Posventa $posventa){
        $this->posventaform->reset();
        return $this->posventaform->descargar_pdf($posventa);
    }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function modal_devolucion(Posventa $posventa){
        $this->devolucionform->agregar_datos_venta($posventa);
    }

    public function save_devolucion(){
        $this->devolucionform->crear_devolucion();
        $this->dispatch('cerrar_modal_devolucion');
    }

    public function descargar_factura(Posventa $posventa){
        return response()->download(storage_path('app/public/'.$posventa->invoice->pdf));
    }
    public function descargar_factura_anulada(Posventa $posventa){
        return response()->download(storage_path('app/public/'.$posventa->cinvoice->pdf));
    }


    public function render()
    {
        $posventas = Posventa::query()->Where(function($query) {
            $query->where('cliente_name','like',"%".$this->search."%")
                  ->orwhere('id','like',"%".$this->search."%");
        });

        $posventas->when($this->salmacen <> '',function ($q) {
            return $q->where('almacen_id',$this->salmacen);
        });

        $posventas->when($this->salmacen <> '',function ($q) {
            return $q->where('almacen_id',$this->salmacen);
        });

        $posventas->when($this->sfacturacion == 'sinfactura'  ,function ($q) {
            return $q->whereNull('invoice_id');
        });

        $posventas->when($this->sfacturacion == 'factura'  ,function ($q) {
            return $q->whereNotNull('invoice_id');
        });

        $posventas->when($this->finicio != null && $this->ffinal != null  ,function ($q) {
            return $q->where('created_at','>=',$this->finicio." 00:00:00")->where('created_at','<=',$this->ffinal." 23:59:59");
        });

        $posventas = $posventas->orderByDesc('id')->paginate($this->pagina);

        $almacens = Almacen::all();
        return view('livewire.gestionar-ventas', compact('posventas','almacens'));
    }
}
