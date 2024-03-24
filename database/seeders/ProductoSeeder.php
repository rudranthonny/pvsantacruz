<?php

namespace Database\Seeders;

use App\Models\CompuestoProducto;
use App\Models\Producto;
use App\Models\ProductoAlmacen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $producto = new Producto();
        $producto -> imagen = null;
        $producto -> designacion = "designacion producto1";
        $producto -> codigo = "123454";
        $producto -> simbologia = 1;
        $producto -> categoria_id = 1;
        $producto -> marca_id = 1;
        $producto -> impuesto_orden = '18';
        $producto -> metodo_impuesto = 'exclusivo';
        $producto -> descripcion = 'esto es la descripción del producto1';
        $producto -> tipo = "estandar";
        $producto -> costo = 3;
        $producto -> precio = 5;
        $producto -> unitario = 1;
        $producto -> venta_unidad = 1;
        $producto -> compra_unidad = 1;
        $producto -> alerta_stock = 15;
        $producto -> save();

        $producto = new Producto();
        $producto -> imagen = null;
        $producto -> designacion = "designacion producto2";
        $producto -> codigo = "654321";
        $producto -> simbologia = 1;
        $producto -> categoria_id = 1;
        $producto -> marca_id = 1;
        $producto -> impuesto_orden = '18';
        $producto -> metodo_impuesto = 'exclusivo';
        $producto -> descripcion = 'esto es la descripción del producto 2';
        $producto -> tipo = "estandar";
        $producto -> costo = 3;
        $producto -> precio = 5;
        $producto -> unitario = 1;
        $producto -> venta_unidad = 1;
        $producto -> compra_unidad = 1;
        $producto -> alerta_stock = 15;
        $producto -> save();

        $producto = new Producto();
        $producto -> imagen = null;
        $producto -> designacion = "designacion producto3";
        $producto -> codigo = "4444444";
        $producto -> simbologia = 1;
        $producto -> categoria_id = 1;
        $producto -> marca_id = 1;
        $producto -> impuesto_orden = '18';
        $producto -> metodo_impuesto = 'exclusivo';
        $producto -> descripcion = 'esto es la descripción del producto 3';
        $producto -> tipo = "compuesto";
        $producto -> costo = 3;
        $producto -> precio = 5;
        $producto -> unitario = 1;
        $producto -> venta_unidad = 1;
        $producto -> compra_unidad = 1;
        $producto -> alerta_stock = 15;
        $producto -> save();

        $nproducto_compuesto = new CompuestoProducto();
        $nproducto_compuesto->producto_id = 3;
        $nproducto_compuesto->producto_asignado_id = 1;
        $nproducto_compuesto->cantidad = 1;
        $nproducto_compuesto->save();

        $nproducto_compuesto = new CompuestoProducto();
        $nproducto_compuesto->producto_id = 3;
        $nproducto_compuesto->producto_asignado_id = 2;
        $nproducto_compuesto->cantidad = 1;
        $nproducto_compuesto->save();
    }
}
