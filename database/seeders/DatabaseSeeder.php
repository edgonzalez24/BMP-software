<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\UserSeeder;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\CategoryArticleSeeder;
use Database\Seeders\MeasureUnitsSeeder;
use Database\Seeders\SupplierSeeder;
use Database\Seeders\ArticleSeeder;

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
        ]);
        
        $this->call(PermissionsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategoryArticleSeeder::class);
        $this->call(MeasureUnitsSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(ArticleSeeder::class);

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
