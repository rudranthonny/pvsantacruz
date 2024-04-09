<?php

namespace App\Livewire\Forms;

use App\Models\Cliente;
use App\Models\PagoDeuda;
use App\Models\PagoRelacionado;
use App\Models\Posventa;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ClientesForm extends Form
{
    public ?Cliente $cliente;

    public $name;
    public $email;
    public $telefono;
    public $nit;
    public $pais;
    public $ciudad;
    public $numero_impuesto;
    public $direccion;

    public function set(Cliente $cliente){
        $this->cliente = $cliente;
        $this->name = $cliente->name;
        $this->email = $cliente->email;
        $this->nit = $cliente->nit;
        $this->telefono = $cliente->telefono;
        $this->pais = $cliente->pais;
        $this->ciudad = $cliente->ciudad;
        $this->numero_impuesto = $cliente->numero_impuesto;
        $this->direccion = $cliente->direccion;
    }

    public function generar_pago_deuda($monto,$opcion,$detalle)
    {
        if ($this->cliente)
        {
            #registrar pago del cliente
            $n_pago_deuda = new PagoDeuda();
            $n_pago_deuda->cliente_id = $this->cliente->id;
            $n_pago_deuda->monto =  $monto;
            $n_pago_deuda->detalle = $detalle;
            $n_pago_deuda->opcion = $opcion;
            $n_pago_deuda->fecha = date('Y-m-d');
            $n_pago_deuda->save();

            $this->cliente->deuda_total = $this->cliente->deuda_total-$monto;
            $this->cliente->save();

            $monto_a_pagar = $monto;
            $consultar_deudas = Posventa::where('cliente_id',$this->cliente->id)->where('estado_posventa','parcial')->whereNotNull('monto_pendiente')->get();
            foreach ($consultar_deudas as $key => $posve)
            {
                if ($monto_a_pagar == 0) {break;}
                else {
                    $bpago_relacionado = PagoRelacionado::where('posventa_id',$posve->id)->sum('monto_pagado');
                    $monto_faltante_pagar = $posve->monto_pendiente-$bpago_relacionado;
                        if ($monto_a_pagar >= $monto_faltante_pagar)
                        {
                            $n_pago_rel = new PagoRelacionado();
                            $n_pago_rel->pago_deuda_id = $n_pago_deuda->id;
                            $n_pago_rel->monto_pendiente = $monto_faltante_pagar;
                            $n_pago_rel->monto_pagado = $monto_faltante_pagar;
                            $n_pago_rel->monto_restante = $n_pago_rel->monto_pendiente-$n_pago_rel->monto_pagado;
                            $n_pago_rel->estado = 'Completo';
                            $n_pago_rel->posventa_id = $posve->id;
                            $n_pago_rel->save();
                            $posve->estado_posventa = 'Completo';
                            $posve->save();
                            $monto_a_pagar = $monto_a_pagar - $monto_faltante_pagar;
                        }
                        else {
                            $n_pago_rel = new PagoRelacionado();
                            $n_pago_rel->pago_deuda_id = $n_pago_deuda->id;
                            $n_pago_rel->monto_pendiente = $monto_faltante_pagar;
                            $n_pago_rel->monto_pagado = $monto_a_pagar;
                            $n_pago_rel->monto_restante = $n_pago_rel->monto_pendiente-$n_pago_rel->monto_pagado;
                            $n_pago_rel->estado ='Pendiente';
                            $n_pago_rel->posventa_id = $posve->id;
                            $n_pago_rel->save();
                            $monto_a_pagar = 0;
                        }
                }
            }
        }
    }
    public function update(){
        $this->validate(['name'=> 'required']);
        $this->cliente->update($this->all());
    }

    public function store()
    {
        $this->validate(['name'=> 'required']);
        Cliente::create($this->all());
    }
}
