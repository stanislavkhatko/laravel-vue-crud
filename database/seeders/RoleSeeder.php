<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
    }
}
