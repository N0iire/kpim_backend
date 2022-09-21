<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PembelianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_catatanBeli' => mt_rand(1, 50),
            'id_barang' => mt_rand(1, 50),
            'jumlah' => $this->faker->randomNumber(2),
            'sub_total' => $this->faker->randomNumber(6)
        ];
    }
}
