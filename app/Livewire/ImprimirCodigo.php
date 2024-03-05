<?php

namespace App\Livewire;

use App\Models\Almacen;
use Livewire\Component;

class ImprimirCodigo extends Component
{
    public $search = '';
    public function render()
    {

        $almacenes = Almacen::all();
        return view('livewire.imprimir-codigo',compact('almacenes'));
    }
}
