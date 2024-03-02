<?php

namespace App\Livewire;

use App\Models\Almacen;
use Livewire\Component;

class GestionarAlmacen extends Component
{
    public Almacen $almacens;

    public function render()
    {
        return view('livewire.gestionar-almacen');
    }
}
