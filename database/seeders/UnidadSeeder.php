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
        $unidad -> name = "Unidad";
        $unidad -> name_cor = "Un";
        $unidad -> unidadb = null;
        $unidad -> operador = "*";
        $unidad -> valor = "1";
        $unidad -> save();

        $unidad = new Unidad();
        $unidad -> name = "kg";
        $unidad -> name_cor = "kg";
        $unidad -> unidadb = 1;
        $unidad -> operador =   "/";
        $unidad -> valor = "1";
        $unidad -> save();

    }
}
