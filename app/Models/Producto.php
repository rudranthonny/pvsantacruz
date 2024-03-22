<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
    'designacion' ,
    'simbologia' ,
    'codigo',
    'categoria_id' ,
    'tipo' ,
    'costo' ,
    'unitario' ,
    'venta_unidad' ,
    'compra_unidad' ,
    'precio' ,
    'metodo_impuesto',
    'alerta_stock',
    ];


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

    public function cunitario()
    {
        return $this->belongsTo(Unidad::class,'unitario');
    }
    public function vunidad()
    {
        return $this->belongsTo(Unidad::class,'venta_unidad');
    }
    public function cunidad()
    {
        return $this->belongsTo(Unidad::class,'compra_unidad');
    }

    public function getObtenerCantidadAttribute(){
        $almacenes = ProductoAlmacen::where('producto_id',$this->id)->get();
        return $almacenes->sum('stock');

    }
}
