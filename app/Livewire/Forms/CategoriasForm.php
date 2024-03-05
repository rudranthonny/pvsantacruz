<?php

namespace App\Livewire\Forms;

use App\Models\Categoria;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoriasForm extends Form
{
    public ?Categoria $categoria;

    #[Rule('required')]
    public $cat_cod;
    public $name;

    public function set(Categoria $categoria){
        $this->categoria = $categoria;
        $this->cat_cod = $categoria->cat_cod;
        $this->name = $categoria->name;
    }

    public function update(){
        $this->validate();
        $this->categoria->update($this->all());
    }

    public function store()
    {
        $this->validate();
        categoria::create($this->all());
    }
}
