<?php

namespace App\Livewire;

use App\Livewire\Forms\ProveedorForm;
use App\Models\Cliente;
use App\Models\Configuracion;
use App\Models\Proveedor;
use Livewire\Component;
use Livewire\WithPagination;

class GestionarProveedor extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public ProveedorForm $proveedorForm;
    public $search = '';
    public $titlemodal = 'Añadir';
    public $pagina = 5;
    public $configuracion;

    public function mount(){ $this->configuracion = Configuracion::find(1);  }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function modal(Proveedor $proveedor = null)
    {
        $this->reset('titlemodal');
        $this->proveedorForm->reset();
        if ($proveedor->id == true) {
            $this->titlemodal = 'Editar';
            $this->proveedorForm->set($proveedor);
        }
    }

    public function guardar()
    {
        if (isset($this->proveedorForm->proveedor->id)) {$this->proveedorForm->update();}
        else {$this->proveedorForm->store();}
        $this->dispatch('cerrar_modal_proveedor');
    }

    public function eliminar(Proveedor $proveedor){
        $proveedor->delete();
        $this->updatedSearch();
    }

    public function render()
    {
        $proveedores = Proveedor::where('name','like','%'.$this->search.'%')->paginate($this->pagina); //metodo
        return view('livewire.gestionar-proveedores',compact('proveedores'));
    }

}
