<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // ----------------------------------------
        // ROLES
        $encargado = Role::create(['name' => 'encargado']);
        $preventa = Role::create(['name' => 'preventa']);
        $despacho = Role::create(['name' => 'despacho']);
        $cuentas = Role::create(['name' => 'cuentas']);


        // **** PERMISOS ****

        /* USUARIOS */
        $user_list = Permission::create(['name' => 'user_list', 'descriptions' => 'Listar usuarios']);
        $user_destroy = Permission::create(['name' => 'user_destroy', 'descriptions' => 'Eliminar un usuario']);
        $user_edit = Permission::create(['name' => 'user_edit', 'descriptions' => 'Editar un usuario']);

        

        // ----------------------------------------
        // **** ASIGNANDO PERMISOS A LOS ROLES ****

        // ----------------- PERMISOS encargado -----------------
        $permission_encargado = [$user_list, ];
        $encargado->syncPermissions($permission_encargado);

    }
}
