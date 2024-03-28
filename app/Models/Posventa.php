<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posventa extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function m_caja(){
        return $this->morphOne('App\Models\Mcaja', 'm_cajable');
    }

    public function posventadetalles(){
        return $this->hasMany(PosventaDetalle::class,'posventa_id');
    }
}
