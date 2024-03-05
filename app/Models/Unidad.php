<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    protected $fillable = ['name_cor','unidad','operador','valor'];
    use HasFactory;
}
