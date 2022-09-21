<?php

namespace Database\Seeders;

use App\Models\SimpananWajib;
use Illuminate\Database\Seeder;

class SimpananWajibSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SimpananWajib::factory(50)->create();
    }
}
