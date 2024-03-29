<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompuestoProducto extends Model
{
    use HasFactory;

    public function producto_principal(){
        return $this->belongsTo(Producto::class,'producto_id');
    }

    public function producto(){
        return $this->belongsTo(Producto::class,'producto_asignado_id');
    }

}
