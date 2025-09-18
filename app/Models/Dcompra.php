<?php

namespace App\Models;

use App\Traits\LogsChanges;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dcompra extends Model
{
    use HasFactory;
    use LogsChanges;
    public function logs(){return $this->morphMany(ModificacionLog::class, 'loggable');}

    public function dcompracompuestos(){return $this->hasMany(Dcompracompuesto::class);}

}
