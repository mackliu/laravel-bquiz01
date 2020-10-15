<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bottom;
class BottomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Bottom::create(['bottom'=>'科技大學版權所有']);
    }
}
