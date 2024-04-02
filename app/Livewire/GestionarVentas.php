<?php

namespace App\Livewire;

use App\Models\Almacen;
use App\Models\Configuracion;
use App\Models\Posventa;
use App\Livewire\Forms\PosVentaForm;
use Livewire\Component;
use Livewire\WithPagination;

class GestionarVentas extends Component
{

    use WithPagination;
    public PosVentaForm $posventaform;
    protected $paginationTheme = 'bootstrap';
    public $pagina = 5;
    public $configuracion;
    public $search,$finicio,$ffinal,$salmacen;
    public function mount(){  $this->configuracion = Configuracion::find(1); }

    public function descargar_venta_pdf(Posventa $posventa){
        $this->posventaform->reset();
        return $this->posventaform->descargar_pdf($posventa);
    }

    public function updatedSearch(){
        $this->resetPage();
    }


    public function render()
    {
        $posventas = Posventa::query()->where('cliente_name','like',"%".$this->search."%")->orderByDesc('id');

        $posventas->when($this->salmacen <> '',function ($q) {
            return $q->where('almacen_id',$this->salmacen);
        });

        $posventas->when($this->finicio != null && $this->ffinal != null  ,function ($q) {
            return $q->where('created_at','>=',$this->finicio)->where('created_at','<=',$this->ffinal);
        });


        $posventas = $posventas->paginate($this->pagina);

        $almacens = Almacen::all();
        return view('livewire.gestionar-ventas', compact('posventas','almacens'));
    }
}
