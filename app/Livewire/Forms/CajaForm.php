<?php

namespace App\Livewire\Forms;

use App\Models\Caja;
use App\Models\MCaja;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CajaForm extends Form
{
    public ?Caja $caja;
    public $fecha_apertura;
    public $fecha_cierra;
    public $observacion;
    public $monto_apertura;
    public $monto;

    public $rules = [
        'fecha_apertura' => 'required',
        ];

    public function set(Caja $caja)
    {
        $this->caja = $caja;
        $this->fecha_apertura = $caja->fecha_apertura;
        $this->fecha_cierra = $caja->fecha_cierra;
        $this->observacion = $caja->observacion;
    }

    public function update(){
        $this->validate();
        $this->caja->fecha_apertura = $this->fecha_apertura;
        $this->caja->fecha_cierra = $this->fecha_cierra;
        $this->caja->observacion = $this->observacion;
        $this->caja->save();
    }

    public function actualizar_monto_apertura_caja($monto){

            $n_mcaja = $this->caja->mcajas->first();
            $n_mcaja->caja_id = $this->caja->id;
            $n_mcaja->tmovimiento_caja_id = 1;
            $n_mcaja->signo = "+";
            $n_mcaja->monto = $monto;
            $n_mcaja->save();
    }

    public function store()
    {
        $this->caja = new Caja();
        $this->caja->user_id = Auth::user()->id;
        $this->caja->monto = $this->monto_apertura > 0 ? $this->monto_apertura : 0;
        $this->caja->fecha_apertura = date('Y-m-d h:i:s');
        $this->caja->save();

        if ($this->monto_apertura > 0) {
            $n_mcaja = new MCaja();
            $n_mcaja->caja_id = $this->caja->id;
            $n_mcaja->tmovimiento_caja_id = 1;
            $n_mcaja->signo = "+";
            $n_mcaja->monto = $this->monto_apertura;
            $n_mcaja->save();
        }
    }
}

