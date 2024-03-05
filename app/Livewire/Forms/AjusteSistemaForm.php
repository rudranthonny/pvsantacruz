<?php

namespace App\Livewire\Forms;

use App\Models\Configuracion;
use Illuminate\Support\Facades\Storage;
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

    public function set(Configuracion $configuracion){
        $this->configuracion = $configuracion;
        $this->moneda_predeterminada = $configuracion->codigo_moneda;
        $this->email_predeterminado = $configuracion->codigo_moneda;
        $this->name = $configuracion->codigo_moneda;
        $this->telefono_empresa = $configuracion->codigo_moneda;
        $this->desarrollador = $configuracion->codigo_moneda;
        $this->pie_pagina = $configuracion->codigo_moneda;
        $this->direccion = $configuracion->codigo_moneda;
        $this->pagina_factura = $configuracion->codigo_moneda;
        $this->pie_pagina_factura = $configuracion->codigo_moneda;
        $this->cotizacion_stock = $configuracion->codigo_moneda;
        $this->almacen_id = $configuracion->codigo_moneda;

    }

    public function update($imagen_logo = null){
        $this->validate();
        $this->configuracion->update($this->all());
        if ($imagen_logo)
        {
            $this->eliminar_imagen();
            $this->subir_imagen($imagen_logo);
        }
    }

    public function store($imagen_logo = null)
    {
        $this->validate();
        $this->configuracion = Configuracion::create($this->all());
        if ($imagen_logo) {
           $this->subir_imagen($imagen_logo);
        }
    }

    public function subir_imagen($imagen)
    {
        $extension = $imagen->extension();
        $img_empresa = $imagen->storeAs('public/logo-empresa', $this->configuracion->id.strtotime(date('Y-m-d h:i:s')).".".$extension);
        $this->configuracion->logo = Storage::url($img_empresa);
        $this->configuracion->save();
    }

    public function eliminar_imagen()
    {
        if ($this->configuracion->logo == true)
        {
            $eliminar = str_replace('storage', 'public', $this->configuracion->logo);
            Storage::delete([$eliminar]);
        }
    }

}
