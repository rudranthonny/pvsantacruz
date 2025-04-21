<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //$Super_Administrador = User::role('Super_Administrador')->get();
        //$Administrador = User::role('Administrador')->get();
        //$Cajero = User::role('Cajero')->get();
        #$Cancha = User::role('Cancha')->get();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        Permission::truncate();
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        #roles
        Role::create(['name' => 'Super_Administrador']);
        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Cajero']);
        Role::create(['name' => 'Cancha']);
        #permisos
        Permission::create(['name' =>'admin.editar.almacenstock']);
        Permission::create(['name' => 'admin.ventas.reporte'])->syncRoles(['Super_Administrador','Administrador']);
        Permission::create(['name' => 'admin.configuracion.ajustesistema'])->syncRoles(['Administrador']);
        Permission::create(['name' => 'admin.index'])->syncRoles(['Administrador','Cajero']);
        Permission::create(['name' => 'admin.moneda'])->syncRoles(['Administrador']);
        Permission::create(['name' => 'admin.canchas'])->syncRoles(['Administrador','Cancha']);
        Permission::create(['name' => 'admin.reservas'])->syncRoles(['Administrador','Cancha']);
        Permission::create(['name' => 'admin.almacen'])->syncRoles(['Administrador']);
        Permission::create(['name' => 'admin.productos'])->syncRoles(['Administrador']);
        Permission::create(['name' => 'admin.marcas'])->syncRoles(['Administrador']);
        Permission::create(['name' => 'admin.codigo_barra'])->syncRoles(['Administrador']);
        Permission::create(['name' => 'admin.categorias'])->syncRoles(['Administrador']);
        Permission::create(['name' => 'admin.unidades'])->syncRoles(['Administrador']);
        Permission::create(['name' => 'search.buscar_productos'])->syncRoles(['Administrador','cajero']);
        Permission::create(['name' => 'search.buscar_proveedor'])->syncRoles(['Administrador','cajero']);
        Permission::create(['name' => 'search.buscar_marca'])->syncRoles(['Administrador','cajero']);
        Permission::create(['name' => 'search.buscar_categoria'])->syncRoles(['Administrador','cajero']);
        Permission::create(['name' => 'search.buscar_productos_compra'])->syncRoles(['Administrador','cajero']);
        Permission::create(['name' => 'admin.productos.consultar'])->syncRoles(['Administrador']);
        Permission::create(['name' => 'admin.compras'])->syncRoles(['Administrador']);
        Permission::create(['name' => 'admin.clientes'])->syncRoles(['Administrador']);
        Permission::create(['name' => 'admin.proveedor'])->syncRoles(['Administrador']);
        Permission::create(['name' => 'admin.usuario'])->syncRoles(['Administrador']);
        Permission::create(['name' => 'admin.gastos.tgastos'])->syncRoles(['Administrador']);
        Permission::create(['name' => 'admin.gastos.index'])->syncRoles(['Administrador']);
        Permission::create(['name' => 'admin.ventas.pos'])->syncRoles(['Administrador','Cajero']);
        Permission::create(['name' => 'admin.ventas.index'])->syncRoles(['Administrador','Cajero']);
        Permission::create(['name' => 'admin.productos.consultar_barra'])->syncRoles(['Administrador','Cajero']);
        Permission::create(['name' => 'search.buscar_cliente'])->syncRoles(['Administrador','Cajero']);

        //if($Super_Administrador->count() > 0){foreach ($Super_Administrador as $key => $sadmin) {$sadmin->assignRole('Super_Administrador');}}

        //if($Administrador->count() > 0){foreach ($Administrador as $key => $admin) {$admin->assignRole('Administrador');}}

        //if($Cajero->count() > 0){foreach ($Cajero as $key => $caj) {$caj->assignRole('Cajero');}}

        #if($Cancha->count() > 0){foreach ($Cancha as $key => $caj2) {$caj2->assignRole('Cancha');}}
    }
}
