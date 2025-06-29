<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Internship>
 */
class InternshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $companies = [
            'PT Teknologi Maju Indonesia', 'CV Digital Solusi', 'PT Inovasi Kreatif', 
            'Startup Tech Indonesia', 'PT Media Digital', 'CV Solusi Teknologi',
            'PT Kreatif Digital', 'Techno Solutions', 'PT Inovasi Muda', 'Digital Creative',
            'PT Maju Bersama', 'CV Teknologi Terdepan', 'PT Solusi Cerdas', 'Innovation Hub',
            'PT Digital Nusantara', 'Creative Tech', 'PT Teknologi Masa Depan', 'Smart Solutions',
            'PT Inovasi Digital', 'Tech Startup Indonesia', 'PT Kreatif Teknologi', 'Digital Innovation',
            'PT Solusi Modern', 'Future Tech', 'PT Teknologi Canggih', 'Creative Solutions',
            'PT Digital Creative', 'Tech Solutions', 'PT Inovasi Terbaru', 'Modern Technology'
        ];

        $positions = [
            'Frontend Developer Intern', 'Backend Developer Intern', 'Full Stack Developer Intern',
            'UI/UX Designer Intern', 'Digital Marketing Intern', 'Content Creator Intern',
            'Social Media Specialist Intern', 'Data Analyst Intern', 'Business Analyst Intern',
            'Product Manager Intern', 'Quality Assurance Intern', 'DevOps Engineer Intern',
            'Mobile Developer Intern', 'Graphic Designer Intern', 'Video Editor Intern',
            'SEO Specialist Intern', 'Customer Service Intern', 'Sales Intern',
            'Human Resources Intern', 'Finance Intern', 'Marketing Research Intern',
            'Project Manager Intern', 'System Administrator Intern', 'Network Engineer Intern',
            'Cybersecurity Intern', 'Machine Learning Intern', 'Data Scientist Intern',
            'Cloud Engineer Intern', 'Technical Writer Intern', 'Business Development Intern'
        ];

        $jobDescriptions = [
            "Bergabunglah dengan tim kami untuk mengembangkan aplikasi web modern menggunakan teknologi terkini. Anda akan belajar tentang pengembangan frontend dan backend, serta berkolaborasi dengan tim yang berpengalaman dalam menciptakan solusi digital yang inovatif.",
            "Kesempatan untuk belajar dan berkontribusi dalam proyek-proyek digital marketing yang menarik. Anda akan terlibat dalam strategi pemasaran digital, analisis data, kampanye media sosial, dan pengembangan konten yang engaging untuk berbagai platform.",
            "Posisi magang yang memberikan pengalaman langsung dalam dunia teknologi informasi. Anda akan bekerja dengan teknologi modern, mengembangkan aplikasi, dan mendapatkan mentoring dari senior developer yang berpengalaman di industri.",
            "Bergabung dengan startup yang sedang berkembang pesat dan rasakan dinamika kerja yang cepat dan inovatif. Anda akan mendapatkan pengalaman berharga dalam lingkungan kerja yang fleksibel dan penuh dengan tantangan menarik.",
            "Kesempatan untuk mengembangkan skill dalam bidang design dan user experience. Anda akan belajar membuat interface yang user-friendly, menarik, dan sesuai dengan kebutuhan pengguna modern.",
            "Program magang yang komprehensif dengan exposure ke berbagai aspek bisnis digital. Anda akan belajar dari praktisi berpengalaman di industri dan terlibat dalam proyek-proyek yang berdampak nyata.",
            "Posisi yang ideal untuk mahasiswa yang ingin memulai karir di bidang teknologi. Anda akan mendapatkan training intensif, pengalaman praktis yang valuable, dan networking dengan profesional di industri tech.",
            "Bergabung dengan tim yang passionate dalam menciptakan solusi teknologi inovatif. Anda akan terlibat dalam seluruh siklus pengembangan produk dari ideation hingga deployment dan maintenance."
        ];

        $qualifications = [
            "• Mahasiswa aktif jurusan Teknik Informatika, Sistem Informasi, atau bidang terkait\n• Memiliki pemahaman dasar tentang programming (HTML, CSS, JavaScript)\n• Mampu bekerja dalam tim dan berkomunikasi dengan baik\n• Memiliki motivasi tinggi untuk belajar teknologi baru\n• Dapat bekerja minimal 20 jam per minggu",
            "• Mahasiswa semester 5 ke atas dengan IPK minimal 3.0\n• Familiar dengan HTML, CSS, JavaScript, dan framework modern\n• Memiliki portfolio atau project pribadi yang dapat ditunjukkan\n• Dapat bekerja full-time selama periode magang\n• Attitude positif, proaktif, dan siap belajar hal baru",
            "• Background pendidikan IT, Design, atau bidang terkait\n• Memahami tools design seperti Figma, Adobe Creative Suite, atau Sketch\n• Memiliki kreativitas tinggi dan eye for detail yang baik\n• Dapat bekerja dengan deadline yang ketat\n• Portfolio yang menunjukkan kemampuan design dan kreativitas",
            "• Mahasiswa jurusan Marketing, Komunikasi, atau bidang terkait\n• Familiar dengan social media platforms dan digital marketing tools\n• Memiliki kemampuan writing dan storytelling yang baik\n• Paham basic digital marketing dan SEO\n• Energik, kreatif, dan up-to-date dengan tren digital",
            "• Mahasiswa aktif minimal semester 4 dengan IPK minimal 2.75\n• Memiliki laptop pribadi dengan spesifikasi yang memadai\n• Dapat commit untuk durasi magang penuh (3-6 bulan)\n• Memiliki keinginan kuat untuk belajar dan berkembang\n• Komunikasi yang baik dan dapat bekerja dalam tim",
            "• Background IT, Engineering, atau Matematika\n• Familiar dengan database, SQL, dan tools analisis data\n• Logical thinking dan problem solving yang baik\n• Dapat bekerja dengan data dalam jumlah besar\n• Detail oriented, teliti, dan memiliki kemampuan analisis yang kuat"
        ];

        $applicationMethods = [
            "Kirimkan CV terbaru, portfolio (jika ada), dan cover letter ke email yang tertera dengan subject: 'Lamaran Magang - [Posisi]'. Proses seleksi meliputi screening CV, interview online via Zoom, dan technical test sesuai bidang. Hasil seleksi akan diinformasikan dalam 1-2 minggu.",
            "Untuk melamar posisi ini, silakan kirim email ke alamat yang tertera dengan melampirkan:\n• CV terbaru dalam format PDF\n• Portfolio atau contoh project (jika ada)\n• Motivation letter yang menjelaskan minat Anda\n• Transkrip nilai terbaru\n\nKami akan menghubungi kandidat yang lolos seleksi administrasi dalam 1-2 minggu.",
            "Proses aplikasi:\n1. Kirim email ke alamat yang tertera\n2. Subject: Lamaran Magang [Nama Posisi] - [Nama Anda]\n3. Lampirkan CV, portfolio, dan cover letter\n4. Ceritakan motivasi dan ekspektasi Anda dalam cover letter\n5. Tunggu konfirmasi dari tim HR untuk tahap selanjutnya",
            "Cara melamar:\n• Submit aplikasi lengkap via email\n• Include CV terbaru, portfolio, dan cover letter\n• Jelaskan pengalaman dan skill yang relevan dengan posisi\n• Proses seleksi: CV screening → Interview → Technical test → Final decision\n• Hasil akan diinformasikan maksimal 2 minggu setelah interview"
        ];

        $benefits = [
            'Uang saku Rp 1.500.000/bulan + Sertifikat',
            'Uang saku Rp 2.000.000/bulan + Mentoring',
            'Uang saku Rp 2.500.000/bulan + Training',
            'Uang saku Rp 1.000.000/bulan + Flexible Hours',
            'Sertifikat + Uang transport + Makan siang',
            'Sertifikat + Networking + Career guidance',
            'Unpaid internship + Intensive mentoring',
            'Uang saku Rp 1.800.000/bulan + Project bonus',
            'Uang saku Rp 3.000.000/bulan + Full benefits',
            'Remote work + Uang saku Rp 1.200.000/bulan',
            'Hybrid work + Uang saku Rp 2.200.000/bulan',
            'Mentoring intensif + Sertifikat + Referensi kerja'
        ];

        $durations = [
            '3 bulan', '4 bulan', '6 bulan', '2 bulan', '5 bulan', '3-6 bulan', '4-6 bulan'
        ];

        return [
            'nama_perusahaan' => $this->faker->randomElement($companies),
            'posisi_magang' => $this->faker->randomElement($positions),
            'deskripsi_pekerjaan' => $this->faker->randomElement($jobDescriptions),
            'kualifikasi' => $this->faker->randomElement($qualifications),
            'durasi_magang' => $this->faker->randomElement($durations),
            'lokasi_magang' => $this->faker->randomElement(['onsite', 'remote', 'hybrid']),
            'benefit' => $this->faker->randomElement($benefits),
            'deadline_pendaftaran' => $this->faker->dateTimeBetween('now', '+3 months'),
            'cara_melamar' => $this->faker->randomElement($applicationMethods),
            'kontak_email' => $this->faker->companyEmail(),
            'kontak_telepon' => $this->faker->phoneNumber(),
            'is_active' => $this->faker->boolean(85), // 85% chance to be active
            'created_by' => User::inRandomOrder()->first()?->id ?? 1,
            'created_at' => $this->faker->dateTimeBetween('-2 months', 'now'),
            'updated_at' => now(),
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    public function remote(): static
    {
        return $this->state(fn (array $attributes) => [
            'lokasi_magang' => 'remote',
        ]);
    }

    public function onsite(): static
    {
        return $this->state(fn (array $attributes) => [
            'lokasi_magang' => 'onsite',
        ]);
    }

    public function hybrid(): static
    {
        return $this->state(fn (array $attributes) => [
            'lokasi_magang' => 'hybrid',
        ]);
    }
}
