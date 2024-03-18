<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['imagen', 'tipo', 'designacion', 'codigo', 'precio', 'cantidad', 'marca_id', 'categoria_id', 'unidad_id',];

    protected function imagen(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (file_exists(storage_path('app/' . $value)) && $value) ? $value : 'imagenes/no-image.png',
        );
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }
}
