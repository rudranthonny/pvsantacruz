<?php

namespace App\Livewire\Forms;

use App\Models\Cancha;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CanchaForm extends Form
{
    public ?Cancha $cancha;
    #[Rule('required|string|max:255')]
    public $name;
    #[Rule('required|numeric')]
    public $costo;
    #[Rule('required')]
    public $almacen_id;

    public function set(Cancha $cancha)
    {
        $this->cancha = $cancha;
        $this->name = $cancha->name;
        $this->costo = $cancha->costo;
        $this->almacen_id = $cancha->almacen_id;
    }

    public function store()
    {
        $this->validate();
        $this->cancha = Cancha::create([
            'name' => $this->name,
            'costo' => $this->costo,
            'almacen_id' => $this->almacen_id]);
        return 'Cancha creada correctamente';
    }

    public function update()
    {
        $this->validate();
        $this->cancha->update([
            'name' => $this->name,
            'costo' => $this->costo,
            'almacen_id' => $this->almacen_id
        ]);
        return 'Cancha actualizada correctamente';
    }
}
