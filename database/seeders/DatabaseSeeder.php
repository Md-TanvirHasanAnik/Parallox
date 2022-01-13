<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => "Admin",
            'role' => User::Roles['Admin'],
            'status' => 1,
            'email' => "admin@parallaxblog.com",
            'password' => bcrypt('aaaaaaaa')
        ]);
        User::create([
            'name' => "User",
            'role' => User::Roles['User'],
            'status' => 1,
            'email' => "user@parallaxblog.com",
            'password' => bcrypt('aaaaaaaa')
        ]);
        User::create([
            'name' => "Staff",
            'role' => User::Roles['Staff'],
            'status' => 1,
            'email' => "staff@parallaxblog.com",
            'password' => bcrypt('aaaaaaaa')
        ]);


        User::create([
            'name' => "User2",
            'role' => User::Roles['User'],
            'status' => 0,
            'email' => "user2@parallaxblog.com",
            'password' => bcrypt('aaaaaaaa')
        ]);

    }
}
