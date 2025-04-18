<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosventaDetalle extends Model
{
    use HasFactory;

    protected $fillable = ["nombre_producto", "precio", "cantidad", "importe"];

    public function posventa()
    {
        return $this->belongsTo(Posventa::class);
    }

}
