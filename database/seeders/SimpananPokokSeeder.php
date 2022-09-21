<?php

namespace Database\Seeders;

use App\Models\SimpananPokok;
use Illuminate\Database\Seeder;

class SimpananPokokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SimpananPokok::factory(50)->create();
    }
}
