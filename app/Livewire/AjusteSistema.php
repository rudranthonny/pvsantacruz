<?php

namespace App\Livewire;

use App\Livewire\Forms\AjusteSistemaForm;
use App\Models\Almacen;
use App\Models\Configuracion;
use App\Models\Moneda;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class AjusteSistema extends Component
{
    use WithFileUploads;
    public AjusteSistemaForm $ajustesistemaform;
    public $imagen_logo;
    public $iteration=1;

    public function mount(){
        $this->reset('imagen_logo');
        $configuracion = Configuracion::find(1);

        $this->ajustesistemaform->reset();
        if ($configuracion) {
            $this->ajustesistemaform->set($configuracion);
        }

    }

    public function save(){

        if (isset($this->ajustesistemaform->configuracion->id)) {
            $this->ajustesistemaform->update($this->imagen_logo);
        }
        else {
            $this->ajustesistemaform->store($this->imagen_logo);
        }
        $this->mount();

    }

    public function render(){
        $this->iteration++;
        $monedas = Moneda::all();
        $almacens = Almacen::all();
        return view('livewire.ajuste-sistema',compact('monedas','almacens'));}
}
