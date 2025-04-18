<?php

namespace App\Livewire;

use App\Livewire\Forms\ClientesForm;
use App\Models\Cliente;
use App\Models\Configuracion;
use App\Models\Tdocumento;
use Livewire\Component;
use Livewire\WithPagination;

class GestionarCliente extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $configuracion;
    public ClientesForm $clientesForm;
    public $search = '';
    public $titlemodal = 'Añadir';
    public $pagina = 5;
    public $pd_monto,$pd_detalle,$pd_opcion;
    public $historial_reservas_cliente, $reservas_historial = [];

    public function abrir_historial_reservas($id)
    {
        $this->historial_reservas_cliente = Cliente::find($id);
        $this->reservas_historial = $this->historial_reservas_cliente->reservas()
            ->with('cancha')
            ->orderBy('fingreso', 'desc')
            ->get();
    }

    public function buscar_documento(){
        $this->clientesForm->consultarDatos();
    }

    public function modal_pagar_deuda(Cliente $cliente){
        $this->reset('pd_monto','pd_detalle','pd_opcion');
        $this->clientesForm->reset();
        $this->clientesForm->set($cliente);
    }

    public function modal_reporte_deudas(Cliente $cliente){
        $this->clientesForm->reset();
        $this->clientesForm->set($cliente);
    }

    public function generar_pago_deuda(){
        $this->validate([
            'pd_monto'=>'required|numeric|min:1',
            'pd_opcion'=>'required',
        ]);
        $this->clientesForm->generar_pago_deuda($this->pd_monto,$this->pd_opcion,$this->pd_detalle);
        $this->dispatch('cerrar_modal_cliente_pagar_deuda');
    }

    public function updatedPdMonto(){
        $this->pd_monto = ($this->pd_monto == false) ? 0 :$this->pd_monto;
        $this->pd_monto = ($this->pd_monto <= $this->clientesForm->cliente->deuda_total) ? $this->pd_monto : 0;
    }

    public function mount(){
        $this->configuracion = Configuracion::find(1);
    }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function modal(Cliente $cliente = null)
    {
        $this->reset('titlemodal');
        $this->clientesForm->reset();
        if ($cliente->id == true) {
            $this->titlemodal = 'Editar';
            $this->clientesForm->set($cliente);
        }
    }

    public function guardar_cliente()
    {
        if (isset($this->clientesForm->cliente->id)) {$this->clientesForm->update();}
        else {
            $this->clientesForm->store();
        }
        $this->dispatch('cerrar_modal_cliente');
    }

    public function eliminar(Cliente $cliente){
        $cliente->delete();
        $this->updatedSearch();
    }

    public function render()
    {
        $documentos = Tdocumento::all();
        $clientes = Cliente::where('name','like','%'.$this->search.'%')->paginate($this->pagina); //metodo
        return view('livewire.gestionar-clientes',compact('clientes','documentos'));
    }

}
