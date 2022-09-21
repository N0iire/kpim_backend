<?php

namespace Database\Seeders;

use App\Models\Cicilan;
use Illuminate\Database\Seeder;

class CicilanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cicilan::factory(100)->create();
    }
}
