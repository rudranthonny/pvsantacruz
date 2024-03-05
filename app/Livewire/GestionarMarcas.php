<?php

namespace App\Livewire;

use App\Livewire\Forms\MarcasForm;
use App\Models\Marca;
use Livewire\Component;
use Livewire\WithPagination;

class GestionarMarcas extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public MarcasForm $marcasForm;
    public $search = '';
    public $titlemodal = 'Añadir';
    public $pagina = 5;

    public function mount(){   }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function modal(Marca $marca = null)
    {
        $this->reset('titlemodal');
        $this->marcasForm->reset();
        if ($marca->id == true) {
            $this->titlemodal = 'Editar';
            $this->marcasForm->set($marca);
        }
    }

    public function guardar()
    {
        if (isset($this->marcasForm->marca->id)) {$this->marcasForm->update();}
        else {$this->marcasForm->store();}
        $this->dispatch('cerrar_modal_marca');
    }

    public function eliminar(Marca $marca){
        $marca->delete();
        $this->updatedSearch();
    }

    public function render()
    {
        $marcas = Marca::where('name','like','%'.$this->search.'%')->paginate($this->pagina); //metodo
        return view('livewire.gestionar-marcas', compact('marcas'));
    }
}
