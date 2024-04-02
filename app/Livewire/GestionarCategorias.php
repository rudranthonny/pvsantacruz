<?php

namespace App\Livewire;

use App\Livewire\Forms\CategoriasForm;
use App\Models\Categoria;
use App\Models\Configuracion;
use Livewire\Component;
use Livewire\WithPagination;

class GestionarCategorias extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $configuracion;
    public CategoriasForm $categoriasForm;
    public $search = '';
    public $titlemodal = 'Añadir';
    public $pagina = 5;

    public function mount(){  $this->configuracion = Configuracion::find(1); }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function modal(Categoria $categoria = null)
    {
        $this->reset('titlemodal');
        $this->categoriasForm->reset();
        if ($categoria->id == true) {
            $this->titlemodal = 'Editar';
            $this->categoriasForm->set($categoria);
        }
    }

    public function guardar()
    {
        if (isset($this->categoriasForm->categoria->id)) {$this->categoriasForm->update();}
        else {$this->categoriasForm->store();}
        $this->dispatch('cerrar_modal_categoria');
    }

    public function eliminar(Categoria $categoria)
    {
        $categoria->delete();
        $this->updatedSearch();
    }

    public function render()
    {
        $categorias = Categoria::where('name','like','%'.$this->search.'%')->paginate($this->pagina); //metodo
        return view('livewire.gestionar-categorias', compact('categorias'));
    }
}
