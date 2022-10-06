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
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Pupuseros',
                    'description' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Tienda',
                    'description' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
    }
}
