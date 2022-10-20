<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\PresaleDetail;

class PresaleDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PresaleDetail::insert([                     
            [
                'total_articles' => '10',
                'dischargued' => false,
                'total' => '45.55',
                'article_id' => 1,
                'presale_id' => 75,
                'created_at' => now(),
                'updated_at' => now(),
            ],                
            [
                'total_articles' => '5',
                'dischargued' => false,
                'total' => '15.55',
                'article_id' => 2,
                'presale_id' => 75,
                'created_at' => now(),
                'updated_at' => now(),
            ],                
            [
                'total_articles' => '8',
                'dischargued' => false,
                'total' => '20.30',
                'article_id' => 3,
                'presale_id' => 74,
                'created_at' => now(),
                'updated_at' => now(),
            ],                
            [
                'total_articles' => '3',
                'dischargued' => false,
                'total' => '12.35',
                'article_id' => 4,
                'presale_id' => 74,
                'created_at' => now(),
                'updated_at' => now(),
            ],              
            [
                'total_articles' => '8',
                'dischargued' => false,
                'total' => '20.30',
                'article_id' => 3,
                'presale_id' => 73,
                'created_at' => now(),
                'updated_at' => now(),
            ],                
            [
                'total_articles' => '3',
                'dischargued' => false,
                'total' => '12.35',
                'article_id' => 4,
                'presale_id' => 73,
                'created_at' => now(),
                'updated_at' => now(),
            ],              
            [
                'total_articles' => '8',
                'dischargued' => false,
                'total' => '20.30',
                'article_id' => 3,
                'presale_id' => 72,
                'created_at' => now(),
                'updated_at' => now(),
            ],                
            [
                'total_articles' => '3',
                'dischargued' => false,
                'total' => '12.35',
                'article_id' => 4,
                'presale_id' => 72,
                'created_at' => now(),
                'updated_at' => now(),
            ],              
            [
                'total_articles' => '8',
                'dischargued' => false,
                'total' => '20.30',
                'article_id' => 3,
                'presale_id' => 71,
                'created_at' => now(),
                'updated_at' => now(),
            ],                
            [
                'total_articles' => '3',
                'dischargued' => false,
                'total' => '12.35',
                'article_id' => 4,
                'presale_id' => 71,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
