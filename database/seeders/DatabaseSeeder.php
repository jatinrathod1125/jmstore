<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => 'password',
                'role' => 'admin',
            ]
        );

        // Customer User
        User::firstOrCreate(
            ['email' => 'rahul@example.com'],
            [
                'name' => 'Rahul Customer',
                'password' => 'password',
                'role' => 'customer',
            ]
        );

        // Call dedicated seeders in order
        $this->call([
            BrandSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            BannerSeeder::class,
        ]);
    }
}
