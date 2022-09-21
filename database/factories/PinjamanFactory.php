<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PinjamanFactory extends Factory
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
            'tgl_pinjaman' => $this->faker->date(),
            'total_pinjaman' => $this->faker->randomNumber(6),
            'nominal_cicilan' => $this->faker->randomNumber(4),
            'jatuh_tempo' => $this->faker->date(),
            'sisa_cicilan' => $this->faker->randomNumber(5),
            'status' => $this->faker->boolean(),
        ];
    }
}
