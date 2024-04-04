<?php

namespace App\Livewire;

use App\Exports\ReporteDevolucionExport;
use App\Livewire\Forms\DevolucionForm;
use App\Models\Almacen;
use App\Models\Configuracion;
use App\Models\Devolucion;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class GestionarDevoluciones extends Component
{

    use WithPagination;
    public DevolucionForm $devolucionform;
    protected $paginationTheme = 'bootstrap';
    public $pagina = 5;
    public $configuracion;
    public $search,$finicio,$ffinal,$salmacen;
    public function mount(){  $this->configuracion = Configuracion::find(1); }


    public function descargar_reporte_devolucions_excel(){
        $devolucions = Devolucion::query()->where('cliente_name','like',"%".$this->search."%")->orderByDesc('id');
        $devolucions->when($this->salmacen <> '',function ($q) { return $q->where('almacen_id',$this->salmacen);});
        $devolucions->when($this->finicio != null && $this->ffinal != null  ,function ($q) {return $q->where('created_at','>=',$this->finicio)->where('created_at','<=',$this->ffinal);});
        $devolucions = $devolucions->get();
        return Excel::download(new ReporteDevolucionExport($devolucions), 'ReporteDevolución.xlsx');
    }



    public function descargar_devolucion_pdf(Devolucion $devolucion)
    {
        return $this->devolucionform->descargar_pdf($devolucion);
    }

    public function updatedSearch(){
        $this->resetPage();
    }



    public function render()
    {
        $devolucions = Devolucion::query()->where('cliente_name','like',"%".$this->search."%")->orderByDesc('id');
        $devolucions->when($this->salmacen <> '',function ($q) { return $q->where('almacen_id',$this->salmacen);});
        $devolucions->when($this->finicio != null && $this->ffinal != null  ,function ($q) {return $q->where('created_at','>=',$this->finicio)->where('created_at','<=',$this->ffinal);});
        $devolucions = $devolucions->paginate($this->pagina);
        $almacens = Almacen::all();
        return view('livewire.gestionar-devoluciones', compact('devolucions','almacens'));
    }
}
