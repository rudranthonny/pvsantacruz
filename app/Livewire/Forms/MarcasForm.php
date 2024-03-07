<?php

namespace App\Livewire\Forms;

use App\Models\Marca;
use Illuminate\Support\Facades\Storage;
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

    public function update($imagen = null){
        $this->validate();
        $this->marca->update($this->only('name','description'));
        if ($imagen) {
            $this->eliminar_imagen_marca();
            $this->subir_imagen_marca($imagen);
        }
    }

    public function store($imagen = null)
    {
        $this->validate();
        $this->marca = Marca::create($this->only('name','description'));
        if ($imagen) {
        $this->subir_imagen_marca($imagen);
        }
    }

    public function eliminar_imagen_marca(){
        if ($this->marca->image == true)
        {
            $eliminar = str_replace('storage', 'public', $this->marca->image);
            Storage::delete([$eliminar]);
        }
    }

    public function subir_imagen_marca($imagen)
    {
        $extension = $imagen->extension();
        $img_marca = $imagen->storeAs('public/marca', $this->marca->id."-".strtotime(date('Y-m-d h:i:s')).".".$extension);
        $this->marca->image = Storage::url($img_marca);
        $this->marca->save();
    }
}
