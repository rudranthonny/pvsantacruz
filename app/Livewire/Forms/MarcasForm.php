<?php

namespace App\Livewire\Forms;

use App\Models\Marca;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class MarcasForm extends Form
{
    public ?Marca $marca;

    #[Rule('required')]
    public $name;
    public $description;
    public $image;

    public function set(Marca $marca){
        $this->marca = $marca;
        $this->name = $marca->name;
        $this->description = $marca->description;
        $this->image = $marca->image;
    }

    public function update(){
        $this->validate();
        $this->marca->update($this->all());
    }

    public function store()
    {
        $this->validate();
        Marca::create($this->all());
    }
}
