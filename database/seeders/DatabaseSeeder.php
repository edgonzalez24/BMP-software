<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\UserSeeder;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\CategoryArticleSeeder;
use Database\Seeders\MeasureUnitsSeeder;
use Database\Seeders\SupplierSeeder;
use Database\Seeders\ArticleSeeder;
use Database\Seeders\StockSeeder;
use Database\Seeders\MethodPaidSeeder;
use Database\Seeders\TypeClientSeeder;
use Database\Seeders\ClientSeeder;
use Database\Seeders\PresaleSeeder;
use Database\Seeders\PresaleDetailSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Reseteando tablas
        $this->truncateTables([
            'suppliers',
            'permissions',
            'roles',
            'role_has_permissions',
            'model_has_permissions',
            'model_has_roles',
            'users',
            'teams',
            'team_invitations',
            'team_user',
            'category_articles',
            'articles',
            'measure_units',
            'stocks',
            'method_paids',
            'type_clients',
            'clients',
            'presales',
            'presale_details',
        ]);
        
        $this->call(PermissionsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategoryArticleSeeder::class);
        $this->call(MeasureUnitsSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(StockSeeder::class);
        $this->call(MethodPaidSeeder::class);
        $this->call(TypeClientSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(PresaleSeeder::class);
        $this->call(PresaleDetailSeeder::class);

    }

    // Método para resetear tablas
    public function truncateTables(array $tables)
    {

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
