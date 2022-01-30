<?php

namespace Database\Factories;

use App\Models\Owner;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'owner_id' => 1,
            'name' => 'hahahaa',
            'location' => 'test lokasi',
            'price' => 512322,
        ];
    }
}


