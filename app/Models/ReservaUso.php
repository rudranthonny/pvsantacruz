<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservaUso extends Model
{
    protected $fillable = [
        'reserva_id' ,
        'reserva_origen_id' ,
        'horas_utilizadas',
        ];

    use HasFactory;

    public function reserva() {return $this->belongsTo(Reserva::class);}
    public function reserva_origen() {return $this->belongsTo(Reserva::class, 'reserva_origen_id');}
}
