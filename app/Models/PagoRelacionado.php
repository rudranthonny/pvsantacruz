<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoRelacionado extends Model
{
    use HasFactory;

    public function posventa()
    {
        return $this->belongsTo(Posventa::class);
    }
}
