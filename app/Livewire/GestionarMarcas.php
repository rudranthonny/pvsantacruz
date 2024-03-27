<?php

namespace App\Livewire;

use App\Livewire\Forms\MarcasForm;
use App\Models\Configuracion;
use App\Models\Marca;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class GestionarMarcas extends Component
{

    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public MarcasForm $marcasForm;
    public $search = '';
    public $titlemodal = 'Añadir';
    public $pagina = 5;
    public $imagen_marca;
    public $iteration = 1;
    public $configuracion;

    public function mount(){ $this->configuracion = Configuracion::find(1);  }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function modal(Marca $marca = null)
    {
        $this->reset('titlemodal','imagen_marca');
        $this->iteration++;
        $this->marcasForm->reset();
        if ($marca->id == true) {
            $this->titlemodal = 'Editar';
            $this->marcasForm->set($marca);
        }
    }

    public function guardar()
    {
        if (isset($this->marcasForm->marca->id)) {$this->marcasForm->update($this->imagen_marca);}

        else {$this->marcasForm->store($this->imagen_marca);}
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
