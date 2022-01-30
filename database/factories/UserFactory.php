<?php

namespace Database\Factories;

use App\Enums\UserTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'phone' => '0880123123123',
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 'test123',
            'credit' => 20,
            'type' => UserTypeEnum::regular(),
        ];
    }
}
