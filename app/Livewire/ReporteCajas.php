<?php

namespace App\Livewire;

use App\Models\Caja;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ReporteCajas extends Component
{
    use WithPagination;

    public $fecha;
    public $usuario_id;
    public $fecha_final;

    public function mount()
    {
        $this->fecha = date('Y-m-d');
        $this->fecha_final = date('Y-m-d');
        $this->usuario_id = '';
    }

    public function render()
    {
        $query = Caja::with(['user', 'mcajas.tmovmientocaja'])
        ->when($this->fecha && $this->fecha_final, function ($q) {$q->whereBetween('fecha_apertura', [$this->fecha, $this->fecha_final]);})
        ->when($this->usuario_id, function ($q) {$q->where('user_id', $this->usuario_id);});

        if ($this->usuario_id) {$query->where('user_id', $this->usuario_id);}

        $cajas = $query->orderByDesc('fecha_apertura')->paginate(10);
        $usuarios = User::orderBy('name')->get();

        return view('livewire.reporte-cajas', compact('cajas', 'usuarios'));
    }
}