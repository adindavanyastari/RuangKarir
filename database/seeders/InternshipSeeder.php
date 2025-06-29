<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Internship;

class InternshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 50 random internships
        Internship::factory(50)->create();

        // Create some specific internships for variety
        Internship::factory(10)->active()->remote()->create();
        Internship::factory(10)->active()->onsite()->create();
        Internship::factory(10)->active()->hybrid()->create();
        
        // Create some inactive internships
        Internship::factory(5)->inactive()->create();

        $this->command->info('✅ Created 75 internship records successfully!');
    }
}
