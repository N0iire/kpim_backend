<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CatatanBeliFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_user' => mt_rand(1, 50),
            'supplier' => $this->faker->name(),
            'tgl_pembelian' => $this->faker->date(),
            'total_pembelian' => $this->faker->randomNumber(6)
        ];
    }
}
