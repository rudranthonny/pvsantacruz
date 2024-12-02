<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Posventa;
use App\Models\PosventaDetalle;
use App\Models\Proveedor;
use App\Models\Tgasto;
use App\Models\User;
use App\Models\ProductoAlmacen;
use App\Models\Almacen;
use App\Models\Devolucion;
use App\Models\Gasto;
use App\Models\Movimiento;
use App\Models\PagoCompra;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //$this->call(RoleSeeder::class);
        $ventas = Posventa::all();
        foreach ($ventas as $key => $ven)
        {
            $ven->cajero_id = isset($ven->m_caja->caja->user_id) ? $ven->m_caja->caja->user_id : NULL;
            $ven->save();
        }
/*
        // \App\Models\User::factory(10)->create();
        // llamar al sembrador de datos en Moneda

        $this->call(RoleSeeder::class);
        $this->call(MonedaSeeder::class);
        $this->call(AlmacenSeeder::class);
        $this->call(MarcaSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(UnidadSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(CompraSeeder::class);
        $this->call(ProveedorSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(TgastoSeeder::class);
        $this->call(TmovimientoCajaSeeder::class);
        $this->call(AjustesSistemaSeed::class);

        $user = User::create([
            'name' => 'Administrador',
            'lastname' => 'Rodriguez',
            'telefono' => '+51 934 665 704',
            'email' => 'test@example.com',
            'username' => 'usuario',
            'email_verified_at' => '2024-03-25 21:16:12',
            'password' => bcrypt('123456789'),
        ]);

        $user->assignRole('Administrador');

         $this->call(TdcoumentoSeeder::class);
         $this->call(CfacturaSeeder::class);
*/
    }

}
