<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'lasith',
            'email' => 'lasith@example.com',
        ]);

        User::factory()->create([
            'name' => 'sara',
            'email' => 'sara@example.com',
        ]);

        User::factory()->create([
            'name' => 'taylor',
            'email' => 'taylor@example.com',
            'role' => 'instructor',
        ]);

        User::factory()->create([
            'name' => 'john',
            'email' => 'john@example.com',
            'role' => 'instructor',
        ]);

        User::factory()->count(10)->create();   //this will create 10 random members

        User::factory()->count(10)->create([
            'role' => 'instructor',
        ]);
    }
}
