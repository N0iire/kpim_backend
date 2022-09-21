<?php

namespace Database\Seeders;

use App\Models\CatatanBeli;
use Illuminate\Database\Seeder;

class CatatanBeliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CatatanBeli::factory(50)->create();
    }
}
