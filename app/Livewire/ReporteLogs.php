<?php

namespace App\Livewire;

use App\Models\ModificacionLog;
use App\Models\User;
use Livewire\Component;

class ReporteLogs extends Component
{
    public $modelo = '';
    public $desde = '';
    public $hasta = '';
    public $usuario_id = '';
    public $modal_id = '';

    public $logs = [];
    public $buscar_usuario = ''; // Buscar por DNI
    public $lista_usuarios;
    public $modelosDisponibles = [
        'App\Models\Posventa'    => 'Ventas',
        'App\Models\ProductoAlmacen'    => 'Productos de Almacen',
    ];
    
    public function mount(){
        $this->desde = date('Y-m-d');
        $this->hasta = date('Y-m-d');
        $this->lista_usuarios = User::all();
    }

    public function consultar()
    {
        $query = ModificacionLog::with('user')
            ->when($this->modelo, fn($q) => $q->where('loggable_type', $this->modelo))
            ->when($this->modal_id, fn($q) => $q->where('loggable_id', $this->modal_id))
            ->when($this->desde, fn($q) => $q->whereDate('created_at', '>=', $this->desde))
            ->when($this->hasta, fn($q) => $q->whereDate('created_at', '<=', $this->hasta))
            ->when($this->buscar_usuario, fn($q) => $q->where('user_id', '<=', $this->buscar_usuario));
        $this->logs = $query->get();
    }

    public function render()
    {
        return view('livewire.reporte-logs', [
            'usuarios' => User::orderBy('name')->get()
        ]);
    }
}
