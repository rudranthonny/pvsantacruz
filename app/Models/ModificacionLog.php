<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModificacionLog extends Model
{
    use HasFactory; 

    protected $fillable = [
        'campo_modificado',
        'valor_anterior',
        'valor_nuevo',
        'user_id',
        'ip',
    ];

    public function loggable(){return $this->morphTo();}
    public function user(){return $this->belongsTo(User::class);}
}
