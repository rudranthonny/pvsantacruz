<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MCaja extends Model
{
    use HasFactory;

    protected $fillable = ['tmovimiento_caja_id', 'caja_id', 'signo', 'monto'];

    public function caja()
    {
        return  $this->belongsTo(Caja::class);
    }

    public function tmovmientocaja()
    {
        return  $this->belongsTo(TmovimientoCaja::class);
    }

    public function m_cajable(){
        return $this->morphTo();
    }
}
