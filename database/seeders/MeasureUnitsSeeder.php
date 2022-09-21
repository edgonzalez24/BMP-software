<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MeasureUnits;

class MeasureUnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MeasureUnits::insert([
            [                
                'name' => 'Sin Asignar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Cajas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Libras',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Sacos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Onzas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Paquetes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Fardos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Cientos de bolsas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Sachets',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Botella',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'name' => 'Galón',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
