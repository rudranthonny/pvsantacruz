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
        $unidad -> name_cor = "kg";
        $unidad -> unidad = "Unidad";
        $unidad -> operador = "/";
        $unidad -> valor = "1";
        $unidad -> save();

        $unidad = new Unidad();
        $unidad -> name_cor = "mt";
        $unidad -> unidad = "metro";
        $unidad -> operador = ".";
        $unidad -> valor = "2";
        $unidad -> save();

        $unidad = new Unidad();
        $unidad -> name_cor = "oz";
        $unidad -> unidad = "volumen";
        $unidad -> operador = "Oz";
        $unidad -> valor = "3";
        $unidad -> save();

        $unidad = new Unidad();
        $unidad -> name_cor = "lt";
        $unidad -> unidad = "Litro";
        $unidad -> operador = "L";
        $unidad -> valor = "4";
        $unidad -> save();

        $unidad = new Unidad();
        $unidad -> name_cor = "suma";
        $unidad -> unidad = "Unidad";
        $unidad -> operador = "+";
        $unidad -> valor = "5";
        $unidad -> save();
    }
}
