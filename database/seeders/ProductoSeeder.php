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
        $producto -> codigo = "codigo1";
        $producto -> marca = "marca1";
        $producto -> categoria_id = "1";
        $producto -> precio = "75";
        $producto -> unidad = "unidad1";
        $producto -> cantidad = "15";
        $producto -> save();

        $producto = new Producto();
        $producto -> imagen = "imagen_2";
        $producto -> tipo = "tipo2";
        $producto -> designacion = "designacion producto2";
        $producto -> codigo = "codigo2";
        $producto -> marca = "marca2";
        $producto -> categoria_id = "2";
        $producto -> precio = "100";
        $producto -> unidad = "unidad2";
        $producto -> cantidad = "20";
        $producto -> save();
    }
}
