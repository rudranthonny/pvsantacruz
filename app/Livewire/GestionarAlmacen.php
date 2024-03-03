<?php

namespace App\Livewire;

use App\Livewire\Forms\AlmacenForm;
use App\Models\Almacen;
use Livewire\Component;

class GestionarAlmacen extends Component
{
    public AlmacenForm $almacenForm;
    public $almacens;
    public $almacenEdits;
    public $titlemodal;

    public function mount()
    {
        $this->almacens = Almacen::all();
        $this->almacenEdits = array();
        $this->titlemodal = 'Añadir';
    }

    public function editar($almacen_id)
    {
        $this->titlemodal = 'Editar';
        $this->almacenEdits = Almacen::find($almacen_id);
    }

    public function guardar()
    {
        $this->almacenForm->save();
    }

    public function render()
    {
        return view('livewire.gestionar-almacen');
    }
}
