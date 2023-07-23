<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(20)
            ->hasReviews(5)
            ->create();

        Location::factory(20)
            ->hasReviews(10)
            ->create();
    }
}
