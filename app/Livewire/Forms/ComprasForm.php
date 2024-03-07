<?php

namespace App\Livewire\Forms;

use App\Models\Compra;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ComprasForm extends Form
{
    public ?Compra $compra;

    #[Rule('required')]
    public $fecha;
    public $refe;
    public $prove;
    public $almacen;
    public $estado;
    public $total;
    public $pagado;
    public $debido;
    public $estado_pago;

    public function set(Compra $compra){
        $this->compra = $compra;
        $this->fecha = $compra->fecha;
        $this->refe = $compra->refe;
        $this->prove = $compra->prove;
        $this->almacen = $compra->almacen;
        $this->estado = $compra->estado;
        $this->total = $compra->total;
        $this->pagado = $compra->pagado;
        $this->debido = $compra->debido;
        $this->estado_pago = $compra->estado_pago;
    }

    public function update(){
        $this->validate();
        $this->compra->update($this->all());
    }

    public function store()
    {
        $this->validate();
        compra::create($this->all());
    }
}
