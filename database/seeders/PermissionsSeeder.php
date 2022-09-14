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

        /* INVITACIONES */
        $send_invitation = Permission::create(['name' => 'send_invitation', 'descriptions' => 'Invitar miembros al sistema']);

        /* CATEGORÍAS DE  ARTÍCULOS*/
        $category_article_index = Permission::create(['name' => 'category_article_index', 'descriptions' => 'Listar todas la categorías']);
        $category_article_create = Permission::create(['name' => 'category_article_create', 'descriptions' => 'Crear categorías']);

        /* ROLES */
        $change_role = Permission::create(['name' => 'change_role', 'descriptions' => 'Cambiar rol']);
        

        // ----------------------------------------
        // **** ASIGNANDO PERMISOS A LOS ROLES ****

        // ----------------- PERMISOS encargado -----------------
        $permission_encargado = [$user_list, $user_destroy, $user_edit, $send_invitation, $change_role, $category_article_index, $category_article_create];
        
        $encargado->syncPermissions($permission_encargado);

    }
}
