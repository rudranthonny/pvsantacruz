<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoAlmacen extends Model
{
    protected $fillable = [
        'producto_id' ,
        'almacen_id' ,
        'stock',
        ];
    use HasFactory;

    public function producto(){
        return $this->belongsTo(Producto::class);
    }

    public function almacen(){
        return $this->belongsTo(Almacen::class);
    }
}

