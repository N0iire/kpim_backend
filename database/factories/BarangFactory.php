<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_barang' => $this->faker->words(mt_rand(1, 3), true),
            'jenis_barang' => $this->faker->words(mt_rand(1, 2), true),
            'satuan' => $this->faker->word(),
            'stok' => $this->faker->randomNumber(mt_rand(1, 2)),
            'status' => $this->faker->boolean(),
            'berat' => $this->faker->randomFloat(mt_rand(1, 2), 1, 30),
            'harga_beli' => $this->faker->randomNumber(6),
            'harga_jual' => $this->faker->randomNumber(6),
        ];
    }
}
