<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Presale>
 */
class PresaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'total_paid' => $this->faker->numberBetween($min = 1, $max = 100),
            'total_pending' => $this->faker->numberBetween($min = 1, $max = 100),
            'dispatch' => $this->faker->numberBetween($min = 0, $max = 1),
            'paid' => $this->faker->numberBetween($min = 0, $max = 1),
            'client_id' => $this->faker->numberBetween($min = 1, $max = 4),
            'user_presale_id' => $this->faker->numberBetween($min = 1, $max = 3),
            'user_dispatch_id' => $this->faker->numberBetween($min = 1, $max = 3),
            'method_paid_id' => $this->faker->numberBetween($min = 1, $max = 3),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
