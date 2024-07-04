<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['codigo',
        'name',
        'email',
        'telefono',
        'pais',
        'nit',
        'ciudad',
        'numero_impuesto',
        'direccion',
        'tdocumento_id'];
    use HasFactory;

    public function pagodeudas()
    {
        return $this->hasMany(PagoDeuda::class);
    }

    public function tdocumento(){
        return $this->belongsTo(Tdocumento::class);
    }
}
