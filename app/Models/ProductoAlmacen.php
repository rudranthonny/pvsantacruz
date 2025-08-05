<?php

namespace App\Models;

use App\Traits\LogsChanges;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoAlmacen extends Model
{
    protected $fillable = [
        'producto_id' ,
        'almacen_id' ,
        'stock',
        ];
    use HasFactory;
    use LogsChanges;


    public function logs(){return $this->morphMany(ModificacionLog::class, 'loggable');}

    public function producto(){return $this->belongsTo(Producto::class);}

    public function almacen(){return $this->belongsTo(Almacen::class);}

    public function getObtenerCantidadAttribute()
    {
        $bproducto = Producto::find($this->producto_id);
        if ($bproducto->tipo == 'estandar') {$numero = $this->stock;}

        if ($bproducto->tipo == 'compuesto')
        {
            $cantidad_stock_disponibles = [];

            foreach ($bproducto->pcompuestos as $key => $pcom)
            {
                $cantidad_stock_disponibles[] = $this->obtener_stock_producto($pcom->producto_asignado_id , $this->almacen_id)/$pcom->cantidad;
            }
            $numero = min($cantidad_stock_disponibles);
        }

        // Obtener la parte entera
        $parteEntera = floor($numero);
        $parteDecimal = $numero - $parteEntera;
        $cpartedecimal = $parteDecimal*$bproducto->cunidad->valor;
        if ($cpartedecimal == 0) {
            return $parteEntera."".$bproducto->cunidad->name_cor;
        }
        else{
            return $parteEntera."".$bproducto->cunidad->name_cor." ".$cpartedecimal."".$bproducto->cunidad->unidadb;
        }

    }

    public function obtener_stock_producto($producto_id,$almacen_id)
    {
        $bproducto = Producto::find($producto_id);
        $consulta_almacen_producto = ProductoAlmacen::where('producto_id',$producto_id)->where('almacen_id',$almacen_id)->first();
        if ($consulta_almacen_producto)
        {
            if ($bproducto->cunidad->operador == "*"){return $consulta_almacen_producto->stock*$bproducto->cunidad->valor;}
            elseif($bproducto->cunidad->operador == "/"){return $consulta_almacen_producto->stock/$bproducto->cunidad->valor;}
            else {return 0;}
        }

        else {return 0;}
    }

    public function malmacens(){return $this->hasMany(Malmacen::class);}
}

