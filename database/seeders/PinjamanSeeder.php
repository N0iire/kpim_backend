<?php

namespace Database\Seeders;

use App\Models\Pinjaman;
use Illuminate\Database\Seeder;

class PinjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pinjaman::factory(50)->create();
    }
}
