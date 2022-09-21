<?php

namespace Database\Seeders;

use App\Models\Pemodal;
use Illuminate\Database\Seeder;

class PemodalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pemodal::factory(10)->create();
    }
}
