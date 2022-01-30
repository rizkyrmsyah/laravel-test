<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OwnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => 1,
            'name' => $this->faker->name(),
            'phone' => '0880123123123',
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 'test123',
        ];
    }
}
