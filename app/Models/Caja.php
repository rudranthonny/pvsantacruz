<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;

    protected $fillable = ["user_id","fecha_apertura",'fecha_cierre','observacion'];

    public function mcajas(){
        return  $this->hasMany(MCaja::class);
    }

    public function mcajas_deleted()
    {
        return $this->hasMany(MCaja::class)->withTrashed();
    }

    public function user(){
        return  $this->belongsTo(User::class);
    }
}
