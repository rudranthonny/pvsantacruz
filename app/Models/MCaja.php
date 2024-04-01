<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MCaja extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['tmovimiento_caja_id', 'caja_id', 'signo', 'monto', 'm_cajable_id', 'm_cajable_type'];

    public function caja()
    {
        return  $this->belongsTo(Caja::class);
    }

    public function tmovmientocaja()
    {
        return  $this->belongsTo(TmovimientoCaja::class,'tmovimiento_caja_id');
    }

    public function m_cajable(){
        return $this->morphTo();
    }
}
