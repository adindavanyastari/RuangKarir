<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\User;
use Faker\Factory as Faker;

class ProfileSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        
        // UBAH DARI 80 MENJADI 20 MAHASISWA SAJA
        for ($i = 1; $i <= 20; $i++) {
            
            // Create user first
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => bcrypt('password123'),
            ]);

            // Then create profile
            Profile::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'nim' => '2024' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'email' => $user->email,
                'prodi' => $faker->randomElement([
                    'Teknik Informatika', 'Sistem Informasi', 'Teknik Kimia', 
                    'Teknik Industri', 'Manajemen', 'Akuntansi', 'Teknik Elektro',
                    'Teknik Mesin', 'Manajemen Rekayasa', 'Teknik Lingkungan'
                ]),
                'fakultas' => $faker->randomElement([
                    'Fakultas Teknologi Industri', 'Fakultas Ekonomi dan Bisnis',
                    'Fakultas Teknik Sipil dan Perencanaan'
                ]),
                'semester' => $faker->numberBetween(1, 8),
                'foto' => 'icon', // GUNAKAN 'icon' SEBAGAI PLACEHOLDER
                'ringkasan_pribadi' => $faker->paragraph(3),
                'hard_skills' => $faker->randomElements([
                    'Laravel', 'PHP', 'JavaScript', 'Python', 'Java', 'React', 'Vue.js',
                    'Node.js', 'MySQL', 'PostgreSQL', 'MongoDB', 'Docker', 'Git',
                    'HTML/CSS', 'Bootstrap', 'Tailwind CSS', 'Adobe Photoshop',
                    'Adobe Illustrator', 'Figma', 'AutoCAD', 'SolidWorks', 'Excel',
                    'PowerBI', 'Tableau', 'R Programming', 'MATLAB', 'Unity',
                    'Flutter', 'React Native', 'WordPress', 'SEO', 'Digital Marketing'
                ], $faker->numberBetween(3, 8)),
                'soft_skills' => $faker->randomElements([
                    'Leadership', 'Communication', 'Teamwork', 'Problem Solving',
                    'Critical Thinking', 'Time Management', 'Adaptability',
                    'Creativity', 'Public Speaking', 'Project Management',
                    'Analytical Thinking', 'Negotiation', 'Conflict Resolution'
                ], $faker->numberBetween(3, 6)),
                'minat_karier' => $faker->randomElements([
                    'Software Developer', 'Data Scientist', 'UI/UX Designer',
                    'Product Manager', 'DevOps Engineer', 'Business Analyst',
                    'Digital Marketing Specialist', 'Cybersecurity Analyst',
                    'Mobile Developer', 'Full Stack Developer', 'System Administrator',
                    'Database Administrator', 'Quality Assurance', 'Technical Writer'
                ], $faker->numberBetween(2, 4)),
                'organisasi_dan_kepanitiaan' => $faker->randomElements([
                    'BEM UISI', 'HMTI', 'HMSI', 'HMTK', 'HMTE', 'HIMA Manajemen',
                    'Panitia Dies Natalis', 'Panitia Wisuda', 'Tim Robotika',
                    'English Club', 'Entrepreneurship Club', 'Volunteer Team'
                ], $faker->numberBetween(1, 4)),
                'proyek' => $faker->randomElements([
                    'E-commerce Website', 'Mobile Banking App', 'Inventory Management System',
                    'Student Information System', 'IoT Smart Home', 'Data Analytics Dashboard',
                    'Social Media Platform', 'Learning Management System', 'POS System',
                    'Weather Monitoring System', 'Chat Application', 'Portfolio Website'
                ], $faker->numberBetween(1, 3)),
                'sertifikat' => $faker->randomElements([
                    'Google Analytics Certified', 'AWS Cloud Practitioner',
                    'Microsoft Azure Fundamentals', 'Cisco CCNA', 'Oracle Database',
                    'Google Ads Certified', 'Facebook Blueprint', 'Scrum Master',
                    'TOEFL iBT', 'IELTS', 'HSK Chinese Proficiency', 'JLPT Japanese'
                ], $faker->numberBetween(1, 3)),
                'penghargaan' => $faker->randomElements([
                    'Juara 1 Programming Contest', 'Best Student Award', 'Dean List',
                    'Outstanding Achievement', 'Innovation Award', 'Leadership Award',
                    'Academic Excellence', 'Community Service Award'
                ], $faker->numberBetween(0, 2)),
                'portofolio' => implode(', ', [
                    'https://github.com/' . strtolower(str_replace(' ', '', $user->name)),
                    'https://linkedin.com/in/' . strtolower(str_replace(' ', '-', $user->name)),
                    'https://' . strtolower(str_replace(' ', '', $user->name)) . '.dev'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}