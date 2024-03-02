<?php

namespace Database\Seeders;

use App\Models\Almacen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlmacenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $almacen = new Almacen();
        $almacen->nombre = 'Almacen 1';
        $almacen->telefono = '999888777';
        $almacen->pais = 'Pais 1';
        $almacen->cuidad = 'Cuidad 1';
        $almacen->email = 'email1@gmail.com';
        $almacen->codigo_postal = 'codigo_postal1';
        $almacen->save();

        $almacen = new Almacen();
        $almacen->nombre = 'Almacen 2';
        $almacen->telefono = '999888777';
        $almacen->pais = 'Pais 2';
        $almacen->cuidad = 'Cuidad 2';
        $almacen->email = 'email2@gmail.com';
        $almacen->codigo_postal = 'codigo_postal2';
        $almacen->save();
    }
}
