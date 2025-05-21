<?php

namespace App\Livewire\Forms;

use App\Models\Cfactura;
use App\Models\Cliente;
use App\Models\PagoDeuda;
use App\Models\PagoRelacionado;
use App\Models\Posventa;
use App\Clases\ConsultaDpiOrCui;
use App\Models\Tdocumento;
use Exception;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;
use SoapClient;

class ClientesForm extends Form
{
    public ?Cliente $cliente;
    use ConsultaDpiOrCui;
    public $name;
    public $tdocumento_id;
    public $email;
    public $telefono;
    public $nit;
    public $pais;
    public $ciudad;
    public $numero_impuesto;
    public $direccion;
    public $gratuito;

    public function set(Cliente $cliente){
        $this->cliente = $cliente;
        $this->name = $cliente->name;
        $this->email = $cliente->email;
        $this->nit = $cliente->nit;
        $this->tdocumento_id = $cliente->tdocumento_id;
        $this->telefono = $cliente->telefono;
        $this->pais = $cliente->pais;
        $this->ciudad = $cliente->ciudad;
        $this->numero_impuesto = $cliente->numero_impuesto;
        $this->direccion = $cliente->direccion;
        $this->gratuito = $cliente->gratuito;
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

    public function consultarDatos()
    {
        $this->validate(['tdocumento_id'=> 'required','nit'=> 'required']);

        $bdocumento = Tdocumento::find($this->tdocumento_id);
        if ($bdocumento->nombre == 'NIT') {
            $datos = $this->consultaDpiOrCui(null,$this->nit);

            if ($datos)
            {
                if ($datos['name'] == 'receptor')
                {
                    $nombre_apellidos = explode(",,",$datos['children']['nombre'][0]['text']);
                    if (isset($nombre_apellidos[1])) {
                        $this->name =  $nombre_apellidos[0]." ".$nombre_apellidos[1];
                    }
                    else {
                        $this->name =  $nombre_apellidos[0];
                    }

                }
                else
                {
                    $this->addError('nit', 'No se encuentra los datos');
                    return;
                }
            }
        }
        else
        {

            $datos = $this->consultaDpiOrCui($bdocumento->nombre,$this->nit);
            if ($datos) {
                if ($datos['name'] == 'receptor')
                {
                    $nombre_apellidos = explode(",",$datos['children']['nombre'][0]['text']);
                    $this->name =  $nombre_apellidos[0]." ".$nombre_apellidos[1];
                }
                else
                {
                    $this->addError('nit', 'No se encuentra los datos');
                    return;
                }
            }
        }
    }

    public function verificarDatos($tdocumento_id,$nit)
    {

        $bdocumento = Tdocumento::find($tdocumento_id);

        if ($bdocumento->nombre == 'NIT')
        {
            $datos = $this->consultaDpiOrCui(null,$nit);

            if ($datos)
            {
                if ($datos['name'] == 'receptor')
                {
                   return true;

                }
                else
                {
                    return false;
                }
            }
            else {
                return false;
            }
        }
        else
        {
            $datos = $this->consultaDpiOrCui($bdocumento->nombre,$nit);
            if ($datos)
            {
                if ($datos['name'] == 'receptor')
                {
                    return true;
                }
                else
                {
                    return false;
                }

            }
            else {
                return false;
            }
        }
    }
}
