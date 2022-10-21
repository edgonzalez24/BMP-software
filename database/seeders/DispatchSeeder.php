<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dispatch;

class DispatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dispatch::insert([
            [
                'name' => 'Pendiente',
            ],
            [
                'name' => 'En proceso',
            ],
            [
                'name' => 'En ruta',
            ],
            [
                'name' => 'Entregado',
            ],
        ]);
    }
}
