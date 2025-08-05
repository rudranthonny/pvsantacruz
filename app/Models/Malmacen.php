<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Malmacen extends Model
{
     use HasFactory;

    protected $fillable = [
        'user_id',
        'producto_almacen_id',
        'valor_anterior',
        'valor_nuevo',
        'descripcion',
    ];

    // 🔗 Usuario que hizo el cambio
    public function user(){return $this->belongsTo(User::class);}

    // 🔗 Producto almacenado que fue modificado
    public function producto_almacen(){return $this->belongsTo(ProductoAlmacen::class);}

    #relación
    public function movimientos(){return $this->morphToMany('App\Models\Movimiento','movimientoable');}
}
