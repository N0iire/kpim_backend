<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BarangSeeder::class,
            CatatanBeliSeeder::class,
            CatatanJualSeeder::class,
            CicilanSeeder::class,
            DetailNonPembelianSeeder::class,
            DetailPinjamanSeeder::class,
            PemasukanSeeder::class,
            PembelianSeeder::class,
            PemodalSeeder::class,
            PengeluaranSeeder::class,
            PenjualanSeeder::class,
            PinjamanSeeder::class,
            SimpananPokokSeeder::class,
            SimpananWajibSeeder::class,
            SimpananSukarelaSeeder::class,
            UserSeeder::class
        ]);
    }
}
