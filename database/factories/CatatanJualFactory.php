<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CatatanJualFactory extends Factory
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
            'nama_pembeli' => $this->faker->name(),
            'tgl_penjualan' => $this->faker->date(),
            'total_penjualan' => $this->faker->randomNumber(7)
        ];
    }
}
