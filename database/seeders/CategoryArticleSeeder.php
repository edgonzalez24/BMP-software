<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoryArticle;

class CategoryArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CategoryArticle::insert([
            [                
                'name' => 'Granos Básicos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Desechables',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Cuidados Personales',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
