<?php

namespace App\Livewire\Forms;

use App\Models\Cliente;
use App\Models\PagoDeuda;
use App\Models\PagoRelacionado;
use App\Models\Posventa;
use GuzzleHttp\Client;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PagoDeudaForm extends Form
{
    public ?PagoDeuda $pagodeuda;
    public ?Cliente $cliente;
    public $cliente_id;
    public $monto;
    public $detalle;
    public $fecha;

    public function set(PagoDeuda $pagoDeuda){
        $this->cliente_id = $pagoDeuda->cliente_id;
        $this->monto = $pagoDeuda->monto;
        $this->detalle = $pagoDeuda->detalle;
        $this->fecha = $pagoDeuda->fecha;
    }

    public function verificar_monto_deuda()
    {
        $this->monto = ($this->monto <= $this->cliente->deuda_total) ? $this->monto : 0 ;
    }


    public function update(){
        $this->validate();
        $this->pagodeuda->update($this->all());
    }

    public function store()
    {
        $this->validate();
        $this->pagodeuda = PagoDeuda::create($this->all());
    }

    public function generar_detalle_pagodeuda(Cliente $cliente,PagoDeuda $pagodeuda){
        $monto_pagodeuda = $pagodeuda->monto;
        $posventas = Posventa::where('estado_posventa',1)->where('cliente_id',$cliente->id)->get();
        foreach ($posventas as $key => $posventa) {
            $pago_relacionado = PagoRelacionado::where('posventa_id',$posventa->id)->sum('monto');

            $monto_pendiente_pagar = $posventa->monto_pendiente-$pago_relacionado;

            if ( $monto_pendiente_pagar > 0 && $monto_pendiente_pagar < $monto_pagodeuda && $monto_pagodeuda>0)
            {
                $n_pago_relacionado = new PagoRelacionado();
                $n_pago_relacionado->posventa_id = $posventa->id;
                $n_pago_relacionado->pago_deuda_id = $pagodeuda->id;
                $n_pago_relacionado->monto = $monto_pendiente_pagar;
                $n_pago_relacionado->save();
                $monto_pagodeuda = $monto_pagodeuda-$monto_pendiente_pagar;
            }
            elseif($monto_pendiente_pagar > 0 && $monto_pendiente_pagar >= $monto_pagodeuda && $monto_pagodeuda>0){
                $n_pago_relacionado = new PagoRelacionado();
                $n_pago_relacionado->posventa_id = $posventa->id;
                $n_pago_relacionado->pago_deuda_id = $pagodeuda->id;
                $n_pago_relacionado->monto = $monto_pagodeuda;
                $n_pago_relacionado->save();
                $monto_pagodeuda = $monto_pagodeuda-$monto_pagodeuda;
            }

        }

    }

}
