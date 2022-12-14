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
            'id_user' => mt_rand(1, 30),
            'tgl_pinjaman' => $this->faker->date(),
            'total_pinjaman' => $this->faker->randomNumber(6),
            'nominal_cicilan' => $this->faker->randomNumber(4),
            'durasi_cicilan' => mt_rand(1, 12),
            'jatuh_tempo' => $this->faker->date(). " " .$this->faker->time(),
            'sisa_cicilan' => $this->faker->randomNumber(5),
            'status' => $this->faker->boolean(),
        ];
    }
}
