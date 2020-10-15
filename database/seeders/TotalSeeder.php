<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Total;

class TotalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Total::create(['total'=>0]);
    }
}
