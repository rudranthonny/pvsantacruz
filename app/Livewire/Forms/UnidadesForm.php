<?php

namespace App\Livewire\Forms;

use App\Models\Unidad;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UnidadesForm extends Form
{
    public ?Unidad $unidad;

    #[Rule('required')]
    public $name;
    public $name_cor;
    public $unidadb;
    public $operador;
    public $valor;

    public function set(Unidad $unidad){
        $this->unidad = $unidad;
        $this->name = $unidad->name;
        $this->name_cor = $unidad->name_cor;
        $this->unidadb = $unidad->unidadb;
        $this->operador = $unidad->operador;
        $this->valor = $unidad->valor;
    }

    public function update(){
        $this->validate();
        $this->unidad->update($this->all());
    }

    public function store()
    {
        $this->validate();
        unidad::create($this->all());
    }
}
