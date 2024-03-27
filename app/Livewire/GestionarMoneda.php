<?php

namespace App\Livewire;

use App\Livewire\Forms\MonedaForm;
use App\Models\Configuracion;
use App\Models\Moneda;
use Livewire\Component;
use Livewire\WithPagination;

class GestionarMoneda extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public MonedaForm $monedasForm;
    public $search = '';
    public $titlemodal = 'Añadir';
    public $pagina = 5;
    public $configuracion;


    public function mount(){  $this->configuracion = Configuracion::find(1); }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function modal(Moneda $moneda = null)
    {
        $this->reset('titlemodal');
        $this->monedasForm->reset();
        if ($moneda->id == true) {
            $this->titlemodal = 'Editar';
            $this->monedasForm->set($moneda);
        }
    }

    public function guardar()
    {
        if (isset($this->monedasForm->moneda->id)) {$this->monedasForm->update();}
        else {$this->monedasForm->store();}
        $this->dispatch('cerrar_modal_moneda');
    }

    public function eliminar(Moneda $moneda){
        $moneda->delete();
        $this->updatedSearch();
    }

    public function render()
    {
        $monedas = Moneda::where('nombre_moneda','like','%'.$this->search.'%')->paginate($this->pagina); //metodo
        return view('livewire.gestionar-moneda',compact('monedas'));
    }

}
