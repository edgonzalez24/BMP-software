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
        
        /* EXISTENCIAS / STOCKS */
        $stock_index = Permission::create(['name' => 'stock_index', 'descriptions' => 'Listar todas las existencias de stock']);
        $stock_create = Permission::create(['name' => 'stock_create', 'descriptions' => 'Crear una entrada en stock']);
        $stock_edit = Permission::create(['name' => 'stock_edit', 'descriptions' => 'Editar editar una entrada en stock']);
        $stock_destroy = Permission::create(['name' => 'stock_destroy', 'descriptions' => 'Eliminar una entrada en stock']);
        $stock_show = Permission::create(['name' => 'stock_show', 'descriptions' => 'Ver entrada de stock']);
        
        /* CLIENTES */
        $client_index = Permission::create(['name' => 'client_index', 'descriptions' => 'Listar todas los clientes']);
        $client_create = Permission::create(['name' => 'client_create', 'descriptions' => 'Crear una entrada en eclientes']);
        $client_edit = Permission::create(['name' => 'client_edit', 'descriptions' => 'Editar editar una entrada en clientes']);
        $client_destroy = Permission::create(['name' => 'client_destroy', 'descriptions' => 'Eliminar una entrada en clientes']);
        
        /* PRE-VENTAS */
        $presale_index = Permission::create(['name' => 'presale_index', 'descriptions' => 'Listar todas las preventas']);
        $presale_create = Permission::create(['name' => 'presale_create', 'descriptions' => 'Crear una entrada en preventas']);
        $presale_edit = Permission::create(['name' => 'presale_edit', 'descriptions' => 'Editar editar una entrada en preventas']);
        $presale_destroy = Permission::create(['name' => 'presale_destroy', 'descriptions' => 'Eliminar una entrada en preventas']);

        /* CUENTAS POR COBRAR */
        $acountHistory_index = Permission::create(['name' => 'acountHistory_index', 'descriptions' => 'Listar todas las preventas marcadas como entregadas y que tienen saldos pendientes de cobro']);
        

        // ----------------------------------------
        // **** ASIGNANDO PERMISOS A LOS ROLES ****

        // ----------------- PERMISOS encargado -----------------
        $permission_encargado = [
            $user_list, $user_destroy, $user_edit, $send_invitation, 
            $change_role, 
            $category_article_index, $category_article_create, $category_article_edit, $category_article_destroy,
            $measure_units_index, $measure_units_create, $measure_units_edit, $measure_units_destroy,
            $supplier_index, $supplier_create, $supplier_edit, $supplier_destroy,
            $article_index, $article_create, $article_edit, $article_destroy,
            $stock_index, $stock_create, $stock_edit, $stock_destroy, $stock_show, 
            $client_index, $client_create, $client_edit, $client_destroy,            
            $presale_index, $presale_create, $presale_edit, $presale_destroy,
            $acountHistory_index,
        ];        
        $encargado->syncPermissions($permission_encargado);

        // ----------------- PERMISOS preventa -----------------
        $permission_preventa = [
            $article_index,
            $stock_index, $stock_show, 
            $client_index,            
            $presale_index, $presale_create, $presale_edit, $presale_destroy,
        ];        
        $preventa->syncPermissions($permission_preventa);

        // ----------------- PERMISOS despacho -----------------
        $permission_despacho = [
            $article_index,
            $client_index,            
            $presale_index, $presale_edit,
        ];        
        $despacho->syncPermissions($permission_despacho);

        // ----------------- PERMISOS cuentas -----------------
        $permission_cuentas = [
            $client_index,
            $acountHistory_index,
        ];        
        $cuentas->syncPermissions($permission_cuentas);

    }
}
