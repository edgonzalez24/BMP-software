<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::insert(
            [            
                [
                    'name' => 'Diana',
                    'telephone' => '0000 - 0000',
                    'email' => 'diana@diana.com',
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Distribuidora Rocosa',
                    'telephone' => '0000 - 0001',
                    'email' => 'dr@dr.com',
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Suli',
                    'telephone' => '0000 - 0002',
                    'email' => 'suli@suli.com',
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
    }
}
