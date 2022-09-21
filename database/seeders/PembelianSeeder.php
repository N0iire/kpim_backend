<?php

namespace Database\Seeders;

use App\Models\Pembelian;
use Illuminate\Database\Seeder;

class PembelianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pembelian::factory(100)->create();
    }
}
