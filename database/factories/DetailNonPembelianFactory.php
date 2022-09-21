<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DetailNonPembelianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_pengeluaran' => mt_rand(1, 10),
            'nama_transaksi' => $this->faker->words(4, true),
            'tgl_transaksi' => $this->faker->date(),
            'nominal_transaksi' => $this->faker->randomNumber(6)
        ];
    }
}
