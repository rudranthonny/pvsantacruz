<?php

namespace App\Livewire;

use App\Models\Configuracion;
use App\Models\Producto;
use Livewire\Component;

class ConsultarProducto extends Component
{
    public $producto;
    public $configuracion;
    public function mount($id)
    {
        $this->producto = Producto::find($id);
        $this->configuracion = Configuracion::find(1);
    }

    public function render()
    {
        return view('livewire.consultar-producto')->layout('administrador.productos.vista_producto');
    }
}
