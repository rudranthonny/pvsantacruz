<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSuperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // $administrador = Role::create(['name' => 'Super_Administrador']);
        $permiso = Permission::where('name', 'admin.usuario.gestor')->first();
        //$permiso2 =    Permission::create(['name' =>'admin.editar.almacenstock']);
     //   Permission::create(['name' =>'admin.ventas.reporte']);

        if ($permiso) {$permiso->syncRoles(['Super_Administrador']);}

        $user = User::find(1);
        $user->assignRole(['Super_Administrador','Administrador']);
    }
}
