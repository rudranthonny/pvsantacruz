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
        'tdocumento_id',
        'gratuito',
    ];
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

    public function getFechaProximaAttribute()
    {
        $numero = $this->getReservasFaltantesAttribute();
        $reservas = $this->reservas()
            ->where('gratuito', false)
            ->where('estado', 'Reservado')
            ->orderBy('fingreso')
        ->get();
         // Verificar que existe la reserva en la posición deseada
        $reserva = $reservas->get($numero); // -1 porque el índice comienza en 0

        return $reserva ? $reserva->fingreso : null; // Si no existe, retorna null
    }

    public function getReservasFaltantesAttribute(){
        $conf = Configuracion::find(1);
        $canthoras = $conf ? $conf->gratuito : 0;
        $horas_utilizadas = $this->reservas()
            ->where('gratuito', false)
            ->where('estado', 'Utilizada')
            ->where('utilizado', false)
            ->get()
        ->sum(function ($reserva) {return max(0, $reserva->horas - $reserva->contador); });
        $horas_utilizadas = $horas_utilizadas+$this->gratuito;
        if($horas_utilizadas > $canthoras){$horas_utilizadas = 0;}
        else {$horas_utilizadas = $canthoras-$horas_utilizadas; }

        return $horas_utilizadas;
    }

    public function getReservasGratuitasDisponiblesAttribute()
    {
        $conf = Configuracion::find(1);
        $canthoras = $conf ? $conf->gratuito : 0;
        $gratuitas_disponibles = 0;

        // Total de horas pagadas y utilizadas
       $horas_utilizadas = $this->reservas()
            ->where('gratuito', false)
            ->where('estado', 'Utilizada')
            ->where('utilizado', false)
            ->get()
            ->sum(function ($reserva) {return max(0, $reserva->horas - $reserva->contador); });
       # Calcular cantidad de horas gratuitas disponibles
       $horas_utilizadas = $horas_utilizadas + $this->gratuito;
        

        if ($canthoras > 0 && $horas_utilizadas > 0) {
            $gratuitas_disponibles = floor($horas_utilizadas / $canthoras);
        }

        return max(0, $gratuitas_disponibles); // nunca devolver negativo
    }
}
