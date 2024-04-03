<?php

namespace App\Livewire\Forms;

use App\Models\CompraPago;
use App\Models\PagoCompra;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PagoCompraForm extends Form
{
    public ?PagoCompra $pagocompra;

    public $compra_id;
    public $fecha_pago;
    public $opcion_pago;
    public $cantidad_recibida;
    public $monto_pago;
    public $cambio;
    public $nota = null;

    public $rules =
    [
        'compra_id' => 'required',
        'fecha_pago' => 'required',
        'opcion_pago' => 'required',
        'cantidad_recibida' => 'required',
        'monto_pago' => 'required',
        'cambio' => 'required',
    ];

    public function set(PagoCompra $pagocompra){
        $this->pagocompra = $pagocompra;
        $this->compra_id = $pagocompra->compra_id;
        $this->fecha_pago = $pagocompra->fecha_pago;
        $this->opcion_pago = $pagocompra->opcion_pago;
        $this->monto_pago = $pagocompra->monto_pago;
        $this->cambio = $pagocompra->cambio;
        $this->nota = $pagocompra->nota;
    }

    public function update(){
        $this->validate($this->rules);
        $this->pagocompra->update($this->all());
    }

    public function store()
    {

        $this->validate($this->rules);
        PagoCompra::create($this->all());
    }
}
