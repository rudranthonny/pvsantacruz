<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoDeuda extends Model
{
    use HasFactory;

    public function pagorelacionados()
    {
        return $this->hasMany(PagoRelacionado::class);
    }
}
