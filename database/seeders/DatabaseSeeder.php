<?php

namespace Database\Seeders;

use App\Models\Movie;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed demo data
        Movie::factory()
            ->count(5)
            ->hasScreenings(7)
            ->create();
    }
}
