<?php

namespace Database\Seeders;

use App\Models\SimpananSukarela;
use Illuminate\Database\Seeder;

class SimpananSukarelaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SimpananSukarela::factory(50)->create();
    }
}
