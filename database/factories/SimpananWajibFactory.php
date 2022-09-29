<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SimpananWajibFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_user' => mt_rand(1, 30),
            'tgl_bayar' => $this->faker->date(),
            'nominal_bayar' => 20000,
            'status' => $this->faker->boolean(),
        ];
    }
}
