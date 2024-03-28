<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cliente = new Cliente();
        $cliente -> name = "Julio Alpezza";
        $cliente -> email = "julio@gmail.com";
        $cliente -> telefono = "958123456";
        $cliente -> pais = "Peru";
        $cliente -> ciudad = "Lima";
        $cliente -> numero_impuesto = "45156";
        $cliente -> direccion = "av. siempre viva 1425";
        $cliente -> save();

        $cliente = new Cliente();
        $cliente -> name = "Sherly Yarinahua";
        $cliente -> email = "shushu@hotmail.com";
        $cliente -> telefono = "959956223";
        $cliente -> pais = "Peru";
        $cliente -> ciudad = "Arequipa";
        $cliente -> numero_impuesto = "51515";
        $cliente -> direccion = "av. matusita 3312";
        $cliente -> save();

        $cliente = new Cliente();
        $cliente -> name = "Dominico Alegria";
        $cliente -> email = "domingo@gmail.com";
        $cliente -> telefono = "981515151";
        $cliente -> pais = "Peru";
        $cliente -> ciudad = "Amazonas";
        $cliente -> numero_impuesto = "151185485";
        $cliente -> direccion = "av. selvaticos 112";
        $cliente -> save();
    }
}
