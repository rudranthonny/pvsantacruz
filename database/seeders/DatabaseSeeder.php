<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Proveedor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // llamar al sembrador de datos en Moneda
        $this->call(MonedaSeeder::class);
        $this->call(AlmacenSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(MarcaSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(UnidadSeeder::class);
        $this->call(CompraSeeder::class);
        $this->call(ProveedorSeeder::class);
        $this->call(ClienteSeeder::class);


    }
}
