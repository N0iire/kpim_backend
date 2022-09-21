<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PemasukanFactory extends Factory
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
            'total_simpanan' => $this->faker->randomNumber(8),
            'total_penjualan' => $this->faker->randomNumber(8),
            'total_pinjaman' => $this->faker->randomNumber(8),
            'total_pemodal' => $this->faker->randomNumber(8)
        ];
    }
}
