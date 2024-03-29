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
        $cliente -> name = "Venta al Publico";
        $cliente -> email = "venta_publico@gmail.com";
        $cliente -> telefono = "958123456";
        $cliente -> pais = "Guatemala";
        $cliente -> ciudad = "Guatemala";
        $cliente -> numero_impuesto = "-----";
        $cliente -> direccion = "-------";
        $cliente -> save();
    }
}
