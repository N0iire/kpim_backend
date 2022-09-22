<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PengeluaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tgl_buat' => $this->faker->date(),
            'total_pembelian' => $this->faker->randomNumber(8),
            'total_pinjaman' => $this->faker->randomNumber(8),
            'total_non_pembelian' => $this->faker->randomNumber(8)
        ];
    }
}
