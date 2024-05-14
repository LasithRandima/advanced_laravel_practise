<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // register the seeder classes and call them before running the database seeder
        $this->call([
            UserSeeder::class,
            ClassTypeSeeder::class,
            ScheduledClassSeeder::class,
        ]);
    }
}
