<?php

namespace App\Livewire\Forms;

use App\Models\Configuracion;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AjusteSistemaForm extends Form
{
    public ?Configuracion $configuracion;

    #[Rule('required')]
    public $moneda_predeterminada;
    #[Rule('required')]
    public $email_predeterminado;
    public $logo;
    #[Rule('required')]
    public $name;
    public $telefono_empresa;
    public $desarrollador;
    public $pie_pagina;
    public $direccion;
    public $pagina_factura;
    public $pie_pagina_factura;
    public $cotizacion_stock;
    #[Rule('required')]
    public $almacen_id;

    public

}
