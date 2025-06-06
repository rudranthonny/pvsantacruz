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
        'marca_id',
        'tipo' ,
        'costo' ,
        'unitario' ,
        'impuesto_orden',
        'venta_unidad' ,
        'compra_unidad' ,
        'precio' ,
        'metodo_impuesto',
        'alerta_stock',
        'ilimitado',
    ];

    public function pcompuestos(){
        return $this->hasMany(CompuestoProducto::class,'producto_id');
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

    public function almacenes(){
        return $this->hasMany(ProductoAlmacen::class,'producto_id');
    }

    public function getObtenerCantidadAttribute(){
        $almacenes = ProductoAlmacen::where('producto_id',$this->id)->get();
        return $almacenes->sum('stock');
    }

    public function getObtenerCostoAttribute(){
        if($this->tipo == 'estandar')
        {
            return $this->costo;
        }
        elseif($this->tipo == 'compuesto')
        {
            $producto = Producto::find($this->id);
            $monto = 0;
            foreach ($producto->pcompuestos as $key => $pcompuesto)
            {
                if ($pcompuesto->producto->cunidad->operador == '*')
                {
                    $monto = $monto + ($pcompuesto->producto->costo/$pcompuesto->producto->cunidad->valor);
                }
                elseif($pcompuesto->producto->cunidad->operador == '/')
                {
                    $monto = $monto + ($pcompuesto->producto->costo*$pcompuesto->producto->cunidad->valor);
                }

                else {$monto = $monto + 0;}
            }
            return $monto;
        }
        else {
            return 0;
        }
    }

    protected function imagen(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (file_exists(storage_path('app/' . $value)) && $value) ? $value : 'imagenes/no-image.png',
        );
    }
}
