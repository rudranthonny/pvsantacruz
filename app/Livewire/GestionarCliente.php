<?php

namespace App\Livewire;

use App\Livewire\Forms\ClientesForm;
use App\Models\Cliente;
use Livewire\Component;
use Livewire\WithPagination;

class GestionarCliente extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public ClientesForm $clientesForm;
    public $search = '';
    public $titlemodal = 'Añadir';
    public $pagina = 5;

    public function mount(){   }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function modal(Cliente $cliente = null)
    {
        $this->reset('titlemodal');
        $this->monedasForm->reset();
        if ($cliente->id == true) {
            $this->titlemodal = 'Editar';
            $this->clientesForm->set($cliente);
        }
    }

    public function guardar()
    {
        if (isset($this->clientesForm->cliente->id)) {$this->clientesForm->update();}
        else {$this->clientesForm->store();}
        $this->dispatch('cerrar_modal_cliente');
    }

    public function eliminar(Cliente $cliente){
        $cliente->delete();
        $this->updatedSearch();
    }

    public function render()
    {
        $clientes = Cliente::where('name','like','%'.$this->search.'%')->paginate($this->pagina); //metodo
        return view('livewire.gestionar-clientes',compact('clientes'));
    }

}
