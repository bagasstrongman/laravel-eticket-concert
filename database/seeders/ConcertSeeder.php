<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConcertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Concert::factory(10)->create();
    }
}
