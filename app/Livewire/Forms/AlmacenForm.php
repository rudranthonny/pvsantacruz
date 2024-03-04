<?php

namespace App\Livewire\Forms;

use App\Models\Almacen;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AlmacenForm extends Form
{
    public ?Almacen $almacen;

    #[Rule('required')]
    public $nombre;
    public $telefono;
    public $pais;
    public $ciudad;
    public $email;
    public $codigo_postal;

    public function set(Almacen $almacen){
        $this->almacen = $almacen;
        $this->nombre = $almacen->nombre;
        $this->telefono = $almacen->telefono;
        $this->pais = $almacen->pais;
        $this->ciudad = $almacen->ciudad;
        $this->email = $almacen->email;
        $this->codigo_postal = $almacen->codigo_postal;
    }

    public function store()
    {
        $this->validate();
        if (isset($this->almacen)) {
            $this->almacen->update($this->all());
            //$this->almacen->save();
        } else {
            Almacen::create($this->all());
        }
    }

}
