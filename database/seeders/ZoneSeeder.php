<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Zone;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Zone::insert([
            [
                'name' => 'Buena Vista',
                'description' => 'Pupusodromo Buena Vista',
            ],
            [
                'name' => 'El Maguito',
                'description' => 'Pupusodromo El Maguito',
            ],
            [
                'name' => 'Sin Especificar',
                'description' => 'Zona sin especificar',
            ],
        ]);
    }
}
