<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MethodPaid;

class MethodPaidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MethodPaid::insert(
            [            
                [
                    'name' => 'Factura por Factura',
                    'description' => 'El cliente paga la factura anterior inmediata y se le emite una nueva factura',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Cash',
                    'description' => 'El cliente paga contra entrega',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Crédito',
                    'description' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
    }
}
