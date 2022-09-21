<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SimpananPokokFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_user' => $this->faker->unique()->numberBetween(1, 50),
            'tgl_bayar' => $this->faker->date(),
            'nominal_pokok' => 50000,
        ];
    }
}
