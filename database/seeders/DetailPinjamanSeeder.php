<?php

namespace Database\Seeders;

use App\Models\DetailPinjaman;
use Illuminate\Database\Seeder;

class DetailPinjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DetailPinjaman::factory(100)->create();
    }
}
