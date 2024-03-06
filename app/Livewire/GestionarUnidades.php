<?php

namespace App\Livewire;

use App\Livewire\Forms\UnidadesForm;
use App\Models\Unidad;
use Livewire\Component;
use Livewire\WithPagination;

class GestionarUnidades extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public UnidadesForm $unidadesForm;
    public $search = '';
    public $titlemodal = 'Añadir';
    public $pagina = 5;

    public function mount(){   }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function modal(Unidad $unidad = null)
    {
        $this->reset('titlemodal');
        $this->unidadesForm->reset();
        if ($unidad->id == true) {
            $this->titlemodal = 'Editar';
            $this->unidadesForm->set($unidad);
        }
    }

    public function guardar()
    {
        if (isset($this->unidadesForm->unidad->id)) {$this->unidadesForm->update();}
        else {$this->unidadesForm->store();}
        $this->dispatch('cerrar_modal_unidad');
    }

    public function eliminar(Unidad $unidad){
        $unidad->delete();
        $this->updatedSearch();
    }

    public function render()
    {
        $unidades = Unidad::where('name','like','%'.$this->search.'%')->paginate($this->pagina); //metodo
        return view('livewire.gestionar-unidades', compact('unidades'));
    }
}
