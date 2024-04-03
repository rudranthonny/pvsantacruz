<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoCompra extends Model
{
    protected $fillable = ["compra_id", "fecha_pago", "opcion_pago",'cantidad_recibida','monto_pago','cambio','nota'];
    use HasFactory;

    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }

}
