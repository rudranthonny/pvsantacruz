<?php

namespace Database\Seeders;

use App\Models\Unidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unidad = new Unidad();
        $unidad -> name = "Kilo";
        $unidad -> name_cor = "kg";
        $unidad -> unidadb = "Unidad";
        $unidad -> operador = "/";
        $unidad -> valor = "1";
        $unidad -> save();

        $unidad = new Unidad();
        $unidad -> name = "Metro";
        $unidad -> name_cor = "mt";
        $unidad -> unidadb = "metro";
        $unidad -> operador = ".";
        $unidad -> valor = "2";
        $unidad -> save();

        $unidad = new Unidad();
        $unidad -> name = "Volumen";
        $unidad -> name_cor = "oz";
        $unidad -> unidadb = "volumen";
        $unidad -> operador = "Oz";
        $unidad -> valor = "3";
        $unidad -> save();

        $unidad = new Unidad();
        $unidad -> name = "Litro";
        $unidad -> name_cor = "lt";
        $unidad -> unidadb = "Litro";
        $unidad -> operador = "L";
        $unidad -> valor = "4";
        $unidad -> save();

        $unidad = new Unidad();
        $unidad -> name = "Suma";
        $unidad -> name_cor = "suma";
        $unidad -> unidadb = "Unidad";
        $unidad -> operador = "+";
        $unidad -> valor = "5";
        $unidad -> save();
    }
}
