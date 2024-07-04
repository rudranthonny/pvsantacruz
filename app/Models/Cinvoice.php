<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinvoice extends Model
{

    use HasFactory;
    protected $fillable = ['cliente_id ','fecha_anulacion','fecha_certificacion','xml','pdf'];
}
