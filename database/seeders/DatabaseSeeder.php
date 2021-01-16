<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class DatabaseSeeder
 * @package Database\Seeders
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seed default roles
        DB::table('roles')->insert([[
            'role' => 'admin',
            'name' => 'Admin'
        ], [
            'role' => 'reader',
            'name' => 'Reader'
        ]]);

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
