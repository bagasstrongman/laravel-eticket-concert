<?php

namespace Database\Seeders;

use App\Models\Concert;
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
        if (Concert::count() == 0) {
            $concerts = Concert::factory(10)->make();

            Concert::insert($concerts->toArray());
        }
    }
}
