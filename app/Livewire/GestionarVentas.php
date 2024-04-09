<?php

namespace App\Livewire;

use App\Exports\ReporteVentasExport;
use App\Livewire\Forms\DevolucionForm;
use App\Models\Almacen;
use App\Models\Configuracion;
use App\Models\Posventa;
use App\Livewire\Forms\PosVentaForm;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class GestionarVentas extends Component
{

    use WithPagination;
    public PosVentaForm $posventaform;
    public DevolucionForm $devolucionform;
    protected $paginationTheme = 'bootstrap';
    public $pagina = 5;
    public $configuracion;
    public $search,$finicio,$ffinal,$salmacen;
    public function mount(){  $this->configuracion = Configuracion::find(1); }

    public function updatedDevolucionform(){$this->devolucionform->actualizar_datos();
    }

    public function eliminar_item_devolucion($item_id){
        $this->devolucionform->eliminar_item_devolucion($item_id);
    }

    public function descargar_reporte_ventas_excel(){
        $posventas = Posventa::query()->where('cliente_name','like',"%".$this->search."%")->orderByDesc('id');

        $posventas->when($this->salmacen <> '',function ($q) {
            return $q->where('almacen_id',$this->salmacen);
        });

        $posventas->when($this->finicio != null && $this->ffinal != null  ,function ($q) {
            return $q->where('created_at','>=',$this->finicio)->where('created_at','<=',$this->ffinal);
        });

        $posventas = $posventas->get();
        return $this->posventaform->descargar_reporte_ventas_excel($posventas);
    }

    public function descargar_reporte_ventas_pdf(){
        $posventas = Posventa::query()->where('cliente_name','like',"%".$this->search."%")->orderByDesc('id');

        $posventas->when($this->salmacen <> '',function ($q) {
            return $q->where('almacen_id',$this->salmacen);
        });

        $posventas->when($this->finicio != null && $this->ffinal != null  ,function ($q) {
            return $q->where('created_at','>=',$this->finicio)->where('created_at','<=',$this->ffinal);
        });

        $posventas = $posventas->get();
        return $this->posventaform->descargar_reporte_ventas_pdf($posventas);
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

    public function render()
    {
        $posventas = Posventa::query()->where('cliente_name','like',"%".$this->search."%")->orderByDesc('id');

        $posventas->when($this->salmacen <> '',function ($q) {
            return $q->where('almacen_id',$this->salmacen);
        });

        $posventas->when($this->finicio != null && $this->ffinal != null  ,function ($q) {
            return $q->where('created_at','>=',$this->finicio." 00:00:00")->where('created_at','<=',$this->ffinal." 23:59:59");
        });


        $posventas = $posventas->paginate($this->pagina);

        $almacens = Almacen::all();
        return view('livewire.gestionar-ventas', compact('posventas','almacens'));
    }
}
