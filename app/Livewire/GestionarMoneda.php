<?php

namespace App\Livewire;

use App\Models\Moneda;
use Livewire\Component;

class GestionarMoneda extends Component
{
    public $monedas; //propiedad

    public $titlemodal;

    public function mount()
    {
        $this->monedas = Moneda::all(); //metodo
        $this->titlemodal = "añadir";
    }

    public function editar($moneda_id)
    {
        $moneda=Moneda::find($moneda_id);
        $moneda->nombre_moneda='Money';
        $moneda->save();
    }

    public function render()
    {
        return view('livewire.gestionar-moneda');
    }

}
