<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(OauthClientSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(InvoiceSeeder::class);
    }
}
