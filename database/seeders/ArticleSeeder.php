<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Article::insert([
            [                
                'name' => 'Frijoles de seda',
                'photo' => null,
                'comment' => 'Frijoles de seda',
                'measure_unit_id' => 1,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Frijoles rojos',
                'photo' => null,
                'comment' => 'Frijoles rojos',
                'measure_unit_id' => 1,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Maseca',
                'photo' => null,
                'comment' => 'Maseca',
                'measure_unit_id' => 2,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Arina de Arroz',
                'photo' => null,
                'comment' => 'Arina de Arroz',
                'measure_unit_id' => 2,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Aceite',
                'photo' => null,
                'comment' => 'Aceite',
                'measure_unit_id' => 2,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Margarina',
                'photo' => null,
                'comment' => 'Margarina',
                'measure_unit_id' => 2,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Sal',
                'photo' => null,
                'comment' => 'Sal',
                'measure_unit_id' => 2,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Azucar',
                'photo' => null,
                'comment' => 'Azucar',
                'measure_unit_id' => 2,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Bolsa #1',
                'photo' => null,
                'comment' => 'Bolsa #1',
                'measure_unit_id' => 2,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Polipel',
                'photo' => null,
                'comment' => 'Polipel',
                'measure_unit_id' => 2,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Aluminio',
                'photo' => null,
                'comment' => 'Aluminio',
                'measure_unit_id' => 2,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Manteca',
                'photo' => null,
                'comment' => 'Manteca',
                'measure_unit_id' => 2,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Consomé',
                'photo' => null,
                'comment' => 'Consomé',
                'measure_unit_id' => 2,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
