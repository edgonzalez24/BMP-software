<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Client::insert([
          [
              'name' => 'Express',
              'telephone' => null,
              'type_client_id' => 3,
              'zone_id' => 3,
              'method_paid_id' => 2,
              'comment' => 'Cliente en tienda',
              'active' => true,
              'created_at' => now(),
              'updated_at' => now(),
          ],
            [
                'name' => 'Pupusería Nenita',
                'telephone' => null,
                'type_client_id' => 2,
                'zone_id' => 1,
                'method_paid_id' => 1,
                'comment' => 'Comentario sobre el cliente',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pupusería Autopista',
                'telephone' => null,
                'type_client_id' => 2,
                'zone_id' => 2,
                'method_paid_id' => 2,
                'comment' => 'Comentario sobre el cliente',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pupusería Gloria',
                'telephone' => null,
                'type_client_id' => 2,
                'zone_id' => 1,
                'method_paid_id' => 1,
                'comment' => 'Comentario sobre el cliente',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pupusería Atardecer',
                'telephone' => null,
                'type_client_id' => 2,
                'zone_id' => 1,
                'method_paid_id' => 1,
                'comment' => 'Comentario sobre el cliente',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pupusería Lo Nuestro',
                'telephone' => null,
                'type_client_id' => 2,
                'zone_id' => 2,
                'method_paid_id' => 3,
                'comment' => 'Comentario sobre el cliente',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
