<?php

namespace Database\Seeders;

use App\Models\Line;
use App\Models\User;
use Illuminate\Database\Seeder;

class TimesAndLinesReadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            \App\Models\TimesRead::factory(10)->state(function ($attributes) use ($user) {
                return [
                    'user_id' => $user->id,
                ];
            })->create();

            \App\Models\LinesRead::factory(10)->state(function ($attributes) use ($user) {
                return [
                    'user_id' => $user->id,
                ];
            })->create();
        }
    }
}
