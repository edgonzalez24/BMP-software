<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Stock;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stock::insert(
            [            
                [
                    'article_id' => 1,
                    'quantity_items' => 30,
                    'units_for_unit' => 30,
                    'buy_price' => '110.00',
                    'sale_price' => '1.25',
                    'supplier_id' => 1,
                    'measure_unit_id' => 2,
                    'comment' => 'Precio de venta es por unidad de acuerdo a cantidad de unidades por unidad de medida',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'article_id' => 2,
                    'quantity_items' => 30,
                    'units_for_unit' => 30,
                    'buy_price' => '110.00',
                    'sale_price' => '1.25',
                    'supplier_id' => 1,
                    'measure_unit_id' => 2,
                    'comment' => 'Precio de venta es por unidad de acuerdo a cantidad de unidades por unidad de medida',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'article_id' => 3,
                    'quantity_items' => 30,
                    'units_for_unit' => 30,
                    'buy_price' => '110.00',
                    'sale_price' => '1.25',
                    'supplier_id' => 1,
                    'measure_unit_id' => 2,
                    'comment' => 'Precio de venta es por unidad de acuerdo a cantidad de unidades por unidad de medida',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'article_id' => 4,
                    'quantity_items' => 30,
                    'units_for_unit' => 30,
                    'buy_price' => '110.00',
                    'sale_price' => '1.25',
                    'supplier_id' => 1,
                    'measure_unit_id' => 2,
                    'comment' => 'Precio de venta es por unidad de acuerdo a cantidad de unidades por unidad de medida',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'article_id' => 5,
                    'quantity_items' => 30,
                    'units_for_unit' => 30,
                    'buy_price' => '110.00',
                    'sale_price' => '1.25',
                    'supplier_id' => 1,
                    'measure_unit_id' => 2,
                    'comment' => 'Precio de venta es por unidad de acuerdo a cantidad de unidades por unidad de medida',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'article_id' => 6,
                    'quantity_items' => 30,
                    'units_for_unit' => 30,
                    'buy_price' => '110.00',
                    'sale_price' => '1.25',
                    'supplier_id' => 1,
                    'measure_unit_id' => 2,
                    'comment' => 'Precio de venta es por unidad de acuerdo a cantidad de unidades por unidad de medida',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'article_id' => 7,
                    'quantity_items' => 30,
                    'units_for_unit' => 30,
                    'buy_price' => '110.00',
                    'sale_price' => '1.25',
                    'supplier_id' => 1,
                    'measure_unit_id' => 2,
                    'comment' => 'Precio de venta es por unidad de acuerdo a cantidad de unidades por unidad de medida',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'article_id' => 8,
                    'quantity_items' => 30,
                    'units_for_unit' => 30,
                    'buy_price' => '110.00',
                    'sale_price' => '1.25',
                    'supplier_id' => 1,
                    'measure_unit_id' => 2,
                    'comment' => 'Precio de venta es por unidad de acuerdo a cantidad de unidades por unidad de medida',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
    }
}
