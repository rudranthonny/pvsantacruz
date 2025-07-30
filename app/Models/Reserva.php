<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = 
    [
        'fingreso',
        'fsalida',
        'horas',
        'costo',
        'subtotal',
        'estado',
        'cancha_id',
        'cliente_id',
        'user_id',
        'posventa_detalle_id',
        'gratuito',
        'utilizado',
        'motivo_anulacion',
    ];
    use HasFactory;
    public function cancha(){return $this->belongsTo(Cancha::class);}
    public function posventadetalle(){return $this->belongsTo(PosventaDetalle::class,'posventa_detalle_id','id');}
    public function cliente(){return $this->belongsTo(Cliente::class);}
    public function user(){return $this->belongsTo(User::class);}

}
