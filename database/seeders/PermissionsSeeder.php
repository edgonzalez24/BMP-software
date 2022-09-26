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
        $category_article_edit = Permission::create(['name' => 'category_article_edit', 'descriptions' => 'Editar categoría']);
        $category_article_destroy = Permission::create(['name' => 'category_article_destroy', 'descriptions' => 'Eliminar categoría']);

        /* ROLES */
        $change_role = Permission::create(['name' => 'change_role', 'descriptions' => 'Cambiar rol']);
        
        /* UNIDADES DE MEDIDA*/
        $measure_units_index = Permission::create(['name' => 'measure_units_index', 'descriptions' => 'Listar todas la unida de medidas']);
        $measure_units_create = Permission::create(['name' => 'measure_units_create', 'descriptions' => 'Crear unida de medidas']);
        $measure_units_edit = Permission::create(['name' => 'measure_units_edit', 'descriptions' => 'Editar unida de medida']);
        $measure_units_destroy = Permission::create(['name' => 'measure_units_destroy', 'descriptions' => 'Eliminar unida de medida']);
        
        /* PROVEEDORES*/
        $supplier_index = Permission::create(['name' => 'supplier_index', 'descriptions' => 'Listar todos los proveedores']);
        $supplier_create = Permission::create(['name' => 'supplier_create', 'descriptions' => 'Crear proveedor']);
        $supplier_edit = Permission::create(['name' => 'supplier_edit', 'descriptions' => 'Editar proveedor']);
        $supplier_destroy = Permission::create(['name' => 'supplier_destroy', 'descriptions' => 'Eliminar proveedor']);
        
        /* ARTÍCULOS*/
        $article_index = Permission::create(['name' => 'article_index', 'descriptions' => 'Listar todos los artículos']);
        $article_create = Permission::create(['name' => 'article_create', 'descriptions' => 'Crear artículo']);
        $article_edit = Permission::create(['name' => 'article_edit', 'descriptions' => 'Editar artículo']);
        $article_destroy = Permission::create(['name' => 'article_destroy', 'descriptions' => 'Eliminar artículo']);

        // ----------------------------------------
        // **** ASIGNANDO PERMISOS A LOS ROLES ****

        // ----------------- PERMISOS encargado -----------------
        $permission_encargado = [
            $user_list, $user_destroy, $user_edit, $send_invitation, 
            $change_role, $category_article_index, $category_article_create,
            $category_article_index, $category_article_create, $category_article_edit, $category_article_destroy,
            $measure_units_index, $measure_units_create, $measure_units_edit, $measure_units_destroy,
            $supplier_index, $supplier_create, $supplier_edit, $supplier_destroy,
            $article_index, $article_create, $article_edit, $article_destroy,
        ];
        
        $encargado->syncPermissions($permission_encargado);

    }
}
