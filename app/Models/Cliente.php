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

    public function reservas(){
        return $this->hasMany(Reserva::class);
    }

    public function getReservasGratuitasDisponiblesAttribute()
    {
        // Total de horas pagadas y utilizadas
        $horas_utilizadas = $this->reservas()
            ->where('gratuito', false)
            ->where('estado', 'Utilizada')
            ->sum('horas');

        // Total de horas gratuitas ya usadas (reservadas o utilizadas)
        $horas_gratuitas_usadas = $this->reservas()
            ->where('gratuito', true)
            ->whereIn('estado', ['Reservado', 'Utilizada'])
            ->sum('horas');

        // Calcular cantidad de horas gratuitas disponibles
        $gratuitas_disponibles = floor($horas_utilizadas / 10) - $horas_gratuitas_usadas;

        return max(0, $gratuitas_disponibles); // nunca devolver negativo
    }
}
