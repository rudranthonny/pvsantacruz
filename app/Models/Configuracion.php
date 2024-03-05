<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $fillable =
    [
        'moneda_predeterminada',
        'email_predeterminado',
        'logo',
        'name',
        'telefono_empresa',
        'desarrollador',
        'pie_pagina',
        'direccion',
        'pagina_factura',
        'pie_pagina_factura',
        'cotizacion_stock',
        'almacen_id',
    ];
    use HasFactory;
}
