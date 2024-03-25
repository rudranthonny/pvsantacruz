<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MCaja extends Model
{
    use HasFactory;

    public function caja()
    {
        return  $this->belongsTo(Caja::class);
    }

    public function tmovmientocaja()
    {
        return  $this->belongsTo(TmovimientoCaja::class);
    }
}
