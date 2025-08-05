<?php

namespace App\Models;

use App\Traits\LogsChanges;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posventa extends Model
{
    use HasFactory, SoftDeletes;
    use LogsChanges;

    protected $fillable = [];

    public function m_caja(){
        return $this->morphOne('App\Models\MCaja', 'm_cajable');
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function posventadetalles()
    {
        return $this->hasMany(PosventaDetalle::class,'posventa_id');
    }

    public function devolucions()
    {
        return $this->hasMany(Devolucion::class,'posventa_id');
    }

    public function movimientos()
    {
        return $this->morphToMany('App\Models\Movimiento','movimientoable');
    }

    public function getObtenerCostoVentaAttribute()
    {
        $posventa = Posventa::find($this->id);
        $total = 0;
        foreach ($posventa->posventadetalles as $key => $detalle) {
            $total = $total + ($detalle->producto_cantidad*$detalle->producto_compra);
        }
        return $total;
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }

    public function cinvoice(){
        return $this->belongsTo(Cinvoice::class);
    }

    public function pagorelacionados(){
        return $this->hasMany(PagoRelacionado::class,'posventa_id');
    }

    public function logs()
    {
        return $this->morphMany(ModificacionLog::class, 'loggable');
    }
}
