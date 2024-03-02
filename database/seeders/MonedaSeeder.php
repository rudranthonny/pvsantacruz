<?php

namespace Database\Seeders;

use App\Models\Moneda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MonedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moneda = new Moneda();
        $moneda -> codigo_moneda = "USD";
        $moneda -> nombre_moneda = "Dolar";
        $moneda -> simbolo = "$";
        $moneda -> save();

        $moneda = new Moneda();
        $moneda -> codigo_moneda = "MXN";
        $moneda -> nombre_moneda = "Peso Mexicano";
        $moneda -> simbolo = "$";
        $moneda -> save();

        $moneda = new Moneda();
        $moneda -> codigo_moneda = "PEN";
        $moneda -> nombre_moneda = "Sol Peruano";
        $moneda -> simbolo = "S/";
        $moneda -> save();
    }
}
