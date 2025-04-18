<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cancha extends Model
{
    protected $fillable = ["name","costo","almacen_id"];
    use HasFactory;

    public function almacen(){return $this->belongsTo(Almacen::class);}

    public function reservas_solicitudes(){return $this->hasMany(Reserva::class,'cancha_id')->whereNotNull('motivo_anulacion')->where('estado','Reservado');}
}

