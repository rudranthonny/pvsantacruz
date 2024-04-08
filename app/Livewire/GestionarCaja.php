<?php

namespace App\Livewire;

use App\Livewire\Forms\CajaForm;
use App\Livewire\Forms\PosVentaForm;
use App\Models\Almacen;
use App\Models\Caja;
use App\Models\Configuracion;
use App\Models\Posventa;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class GestionarCaja extends Component
{
    use WithPagination;
    public CajaForm $CajaForm;
    public PosVentaForm $posventaform;
    protected $paginationTheme = 'bootstrap';
    public $pagina = 5;
    public $configuracion;
    public $search,$finicio,$ffinal,$salmacen;
    public function mount(){  $this->configuracion = Configuracion::find(1); }


    public function descargar_reporte_caja(Caja $caja){
        $this->CajaForm->reset();
        return $this->CajaForm->descargar_reporte_caja_pdf($caja);
    }

    public function descargar_venta_pdf(Posventa $posventa)
    {
        $this->posventaform->reset();
        return $this->posventaform->descargar_pdf($posventa);
    }

    public function updatedSearch(){
        $this->resetPage();
    }


    public function render()
    {

        $cajas = Caja::query()
        ->whereExists(function ($query)
            {
                $query->select()
                    ->from(DB::raw('users'))
                    ->whereColumn( 'users.id','cajas.user_id')
                    ->where(DB::raw("CONCAT(users.lastname,' ',users.name)"),'like', '%' . $this->search.'%');
            })->orderByDesc('id');

        $cajas->when($this->finicio != null && $this->ffinal != null  ,function ($q)  {
            return $q->where('fecha_apertura','>=',$this->finicio.' 00:00:00')->where('fecha_apertura','<=',$this->ffinal.' 23:59:59');
        });

        $cajas = $cajas->paginate($this->pagina);

        return view('livewire.gestionar-caja', compact('cajas'));
    }
}
