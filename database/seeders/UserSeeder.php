<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = User::insert(
        [            
            [
                'name' => 'BMP',
                'email' => 'main.bmp@gmail.com',
                'telephone' => '00000000',
                'email_verified_at' => now(),
                'password' => bcrypt('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Edwin',
                'email' => 'edgoca2498@gmail.com',
                'telephone' => '00000001',
                'email_verified_at' => now(),
                'password' => bcrypt('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Álvaro',
                'email' => 'moralesalvaro308@gmail.com',
                'telephone' => '00000002',
                'email_verified_at' => now(),
                'password' => bcrypt('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $user1 = User::find('1');
        $user1->assignRole('encargado');

        $user2 = User::find('2');
        $user2->assignRole('encargado');

        $user2 = User::find('3');
        $user2->assignRole('encargado');
        
        //User::factory()->count(10)->create();
    }
}
