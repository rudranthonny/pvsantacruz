<?php

namespace App\Livewire\Forms;

use App\Models\Proveedor;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProveedorForm extends Form
{
    public ?Proveedor $proveedor;

    public $codigo;
    #[Rule('required')]
    public $name;
    public $email;
    public $telefono;
    public $pais;
    public $ciudad;
    public $numero_impuesto;
    public $direccion;

    public function set(Proveedor $proveedor){
        $this->proveedor = $proveedor;
        $this->codigo = $proveedor->codigo;
        $this->name = $proveedor->name;
        $this->email = $proveedor->email;
        $this->telefono = $proveedor->telefono;
        $this->pais = $proveedor->pais;
        $this->ciudad = $proveedor->ciudad;
        $this->numero_impuesto = $proveedor->numero_impuesto;
        $this->direccion = $proveedor->direccion;
    }

    public function update(){
        $this->validate();
        $this->proveedor->update($this->all());
    }

    public function store()
    {
        $this->validate();
        $this->codigo = Proveedor::all()->count()+1;
        Proveedor::create($this->all());
    }
}
