<?php

namespace App\Livewire;

use App\Livewire\Forms\TgastoForm;
use App\Models\Configuracion;
use App\Models\Gasto;
use App\Models\Tgasto;
use Livewire\Component;
use Livewire\WithPagination;

class GestionarTgasto extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public TgastoForm $tgastoform;
    public $search = '';
    public $titlemodal = 'Añadir';
    public $pagina = 5;
    public $configuracion;

    public function mount(){$this->configuracion = Configuracion::find(1);   }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function modal(Tgasto $tgasto = null)
    {
        $this->reset('titlemodal');
        $this->tgastoform->reset();
        if ($tgasto->id == true) {
            $this->titlemodal = 'Editar';
            $this->tgastoform->set($tgasto);
        }
    }

    public function guardar()
    {
        if (isset($this->tgastoform->tgasto->id)) {$this->tgastoform->update();}
        else {$this->tgastoform->store();}
        $this->dispatch('cerrar_modal_tgasto');
    }

    public function eliminar(Tgasto $tgasto){
        if ($tgasto->gastos->count() == 0) { $tgasto->delete();}
        $this->updatedSearch();
    }

    public function render()
    {
        $tgastos = Tgasto::where('name','like','%'.$this->search.'%')->paginate($this->pagina); //metodo
        return view('livewire.gestionar-tgasto', compact('tgastos'));
    }
}
