<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed lines
        \App\Models\Line::factory(5000)->create();
    }
}
