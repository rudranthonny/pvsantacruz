<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $n_proveedor = new Proveedor();
        $n_proveedor->name = 'RAPIMARCAS SAS' ;
        $n_proveedor->email = 'RAPIMARCA@com.co' ;
        $n_proveedor->telefono = '7865132' ;
        $n_proveedor->pais = 'Colo' ;
        $n_proveedor->pais = 'Medellin' ;
        $n_proveedor->numero_impuesto = '1' ;
        $n_proveedor->direccion = 'no tiene' ;
        $n_proveedor->save();

    }
}
