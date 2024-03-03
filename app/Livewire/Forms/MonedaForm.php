<?php

namespace App\Livewire\Forms;

use App\Models\Moneda;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class MonedaForm extends Form
{
    public ?Moneda $moneda;

    #[Rule('required')]
    public $codigo_moneda;
    public $nombre_moneda;
    public $simbolo;

    public function set(Moneda $moneda){
        $this->moneda = $moneda;
        $this->codigo_moneda = $moneda->codigo_moneda;
        $this->nombre_moneda = $moneda->nombre_moneda;
        $this->simbolo = $moneda->simbolo;
    }

    public function update(){

    }

    public function store()
    {
        $this->validate();

        Moneda::create($this->all());
    }

    //
}
