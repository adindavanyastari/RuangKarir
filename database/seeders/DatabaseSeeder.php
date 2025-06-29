<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user if not exists
        if (!User::where('email', 'khususkuliah3690@gmail.com')->exists()) {
            User::factory()->create([
                'name' => 'Admin Khusus Kuliah',
                'email' => 'khususkuliah3690@gmail.com',
                'password' => bcrypt('password'), // Ganti dengan password yang aman
            ]);
        }

        // Create additional test users
        User::factory(5)->create();

        // Run internship seeder
        $this->call([
            InternshipSeeder::class,
        ]);
    }
}
