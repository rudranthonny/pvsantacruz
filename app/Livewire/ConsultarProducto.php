<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Component;

class ConsultarProducto extends Component
{
    public $producto;
    public function mount($id)
    {
        $this->producto = Producto::find($id);
    }

    public function render()
    {
        return view('livewire.consultar-producto')->layout('administrador.productos.vista_producto');
    }
}
