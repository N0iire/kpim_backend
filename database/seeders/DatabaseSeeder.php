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
            UserSeeder::class,
            BarangSeeder::class,
            SimpananPokokSeeder::class,
            SimpananWajibSeeder::class,
            SimpananSukarelaSeeder::class,
            CatatanBeliSeeder::class,
            CatatanJualSeeder::class,
            PenjualanSeeder::class,
            PembelianSeeder::class,
            PinjamanSeeder::class,
            CicilanSeeder::class,
            DetailPinjamanSeeder::class,
            PemodalSeeder::class,
            DetailNonPembelianSeeder::class,
            PemasukanSeeder::class,
            PengeluaranSeeder::class,
        ]);
    }
}
