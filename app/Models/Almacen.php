<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'telefono', 'pais', 'ciudad', 'email', 'codigo_postal',];

    public function productoalmacens()
    {
        return $this->hasMany(ProductoAlmacen::class);
    }
}
