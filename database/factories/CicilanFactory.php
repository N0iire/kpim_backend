<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CicilanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_pinjaman' => mt_rand(1, 50),
            'tgl_bayar' => $this->faker->date(),
            'nominal_bayar' => $this->faker->randomNumber(mt_rand(1, 5)),
        ];
    }
}
