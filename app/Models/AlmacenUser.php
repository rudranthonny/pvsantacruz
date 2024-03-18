<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlmacenUser extends Model
{
    use HasFactory;
    public function almacen(){
        return $this->belongsTo(Almacen::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
