<?php

namespace Database\Seeders;

use App\Models\Producto;
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
        $producto -> imagen = "imagen_1";
        $producto -> tipo = "tipo1";
        $producto -> designacion = "designacion producto1";
        $producto -> codigo = "123456789";
        $producto -> costo = "3";
        $producto -> precio = "5";
        $producto -> cantidad = "15";
        $producto -> impuesto_orden = '18';
        $producto -> marca_id = "1";
        $producto -> categoria_id = "1";
        $producto -> unidad_id = "1";
        $producto -> save();

        $producto = new Producto();
        $producto -> imagen = "imagen_2";
        $producto -> tipo = "tipo2";
        $producto -> designacion = "designacion producto2";
        $producto -> codigo = "12347888";
        $producto -> costo = "3";
        $producto -> precio = "5";
        $producto -> cantidad = "20";
        $producto -> impuesto_orden = '18';
        $producto -> marca_id = "2";
        $producto -> categoria_id = "2";
        $producto -> unidad_id = "2";
        $producto -> save();
    }
}
