<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $fillable =
    [
        'fecha',
        'refe',
        'prove',
        'almacen',
        'estado',
        'total',
        'pagado',
        'debido',
        'estado_pago'
    ];
    use HasFactory;
}
