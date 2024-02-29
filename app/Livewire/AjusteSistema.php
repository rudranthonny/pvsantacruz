<?php

namespace App\Livewire;

use App\Models\Configuracion;
use Livewire\Component;

class AjusteSistema extends Component
{
    public Configuracion $configuracion;

    public $rules = [
        'configuracion.moneda_predeterminada' => '',
        'configuracion.email_predeterminado' => '',
        'configuracion.logo' => '',
        'configuracion.name' => '',
        'configuracion.telefono_empresa' => '',
        'configuracion.desarrollador' => '',
        'configuracion.pie_pagina' => '',
        'configuracion.direccion' => '',
        'configuracion.pagina_factura' => '',
        'configuracion.pie_pagina_factura' => '',
        'configuracion.cotizacion_stock' => '',
        'configuracion.almacen_id' => '',
    ];

    public function mount(){$this->configuracion = new Configuracion();}

    public function save() {$this->configuracion->save();}

    public function render(){return view('livewire.ajuste-sistema');}
}
