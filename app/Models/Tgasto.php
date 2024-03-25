<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tgasto extends Model
{
    use HasFactory;
    protected $fillable = ['name','descripcion',];


    public function gastos()
    {
        return $this->hasMany(Gasto::class);
    }
}
