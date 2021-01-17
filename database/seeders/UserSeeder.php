<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed readers
        \App\Models\User::factory(10)->create();

        // Seed an admin
        \App\Models\User::factory(1)->state(function ($attributes) {
            return [
                'role_id' => 1,
                'username' => 'admin',
                'password' => '$2y$10$zqCQu9Lxi/mNt8Myq0MluOw7Bnmp/6ZI76D3mrPl99px1ockSBKPu' // Set password 123456
            ];
        })->create();
    }
}
