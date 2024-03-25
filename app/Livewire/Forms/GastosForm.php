<?php

namespace App\Livewire\Forms;

use App\Models\Gasto;
use Livewire\Attributes\Validate;
use Livewire\Form;

class GastosForm extends Form
{
    public ?Gasto $gasto;
    public $fecha;
    public $almacen_id;
    public $tgasto_id;
    public $monto;
    public $detalles;



    public $rules = [
        'fecha' => 'required',
        'almacen_id' => 'required',
        'tgasto_id' => 'required',
        'monto' => 'required',
        ];

    public function set(Gasto $gasto)
    {
        $this->gasto = $gasto;
        $this->almacen_id = $gasto->almacen_id;
        $this->tgasto_id = $gasto->tgasto_id;
        $this->monto = $gasto->monto;
        $this->detalles = $gasto->detalles;
    }

    public function update(){
        $this->validate();
        $this->gasto->update($this->all());
    }

    public function store()
    {
        $this->validate();
        Gasto::create($this->all());
    }
}
