<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Totla;

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
        Totla::create(['total'=>0]);
    }
}
