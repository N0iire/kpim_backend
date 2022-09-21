<?php

namespace Database\Seeders;

use App\Models\DetailNonPembelian;
use Illuminate\Database\Seeder;

class DetailNonPembelianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DetailNonPembelian::factory(30)->create();
    }
}
