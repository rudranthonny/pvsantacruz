<?php

namespace App\Livewire;

use App\Livewire\Forms\MonedaForm;
use App\Models\Moneda;
use Livewire\Component;

class GestionarMoneda extends Component
{
    public MonedaForm $monedasForm;
    public $monedas; //propiedad

    public $titlemodal;

    public function mount()
    {
        $this->monedas = Moneda::all(); //metodo
        $this->titlemodal = "Añadir";
    }

    public function editar(Moneda $moneda_id)
    {
        $this->titlemodal = 'Editar';
        $this->monedasForm->set($moneda_id);
        //$moneda=Moneda::find($moneda_id);
        //$moneda->nombre_moneda='Money';
        //$moneda->save();
    }

    public function guardar(){
        $this->monedasForm->store();
        $this->monedasForm->reset();

    }

    public function render()
    {
        return view('livewire.gestionar-moneda');
    }

}
