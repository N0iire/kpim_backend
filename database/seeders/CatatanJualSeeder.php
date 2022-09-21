<?php

namespace Database\Seeders;

use App\Models\CatatanJual;
use Illuminate\Database\Seeder;

class CatatanJualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CatatanJual::factory(50)->create();
    }
}
