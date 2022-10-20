<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\TypeClient;

class TypeClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeClient::insert(
            [            
                [
                    'name' => 'Plancheros',
                    'description' => '',
                    'method_paid_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Pupuserias',
                    'description' => '',
                    'method_paid_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Tienda',
                    'description' => '',
                    'method_paid_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
    }
}
