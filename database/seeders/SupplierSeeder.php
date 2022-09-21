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
                    'telephone' => '00000000',
                    'email' => 'diana@diana.com',
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Dsitribuidora Rocosa',
                    'telephone' => '00000001',
                    'email' => 'dr@dr.com',
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Suli',
                    'telephone' => '00000002',
                    'email' => 'suli@suli.com',
                    'active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
    }
}
