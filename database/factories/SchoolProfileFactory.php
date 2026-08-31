<?php

namespace Database\Factories;

use App\Models\SchoolProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SchoolProfile>
 */
class SchoolProfileFactory extends Factory
{
    protected $model = SchoolProfile::class;

    public function definition(): array
    {
        return [
            'name' => 'SMKN 1 Katapang',
            'description' => 'SMKN 1 Katapang merupakan sekolah menengah kejuruan negeri di Kabupaten Bandung yang menyiapkan peserta didik agar unggul, berkarakter, kompetitif, dan adaptif.',
            'history' => 'Sekolah ini sebelumnya dikenal sebagai SMKN 4 Soreang. Pada akhir tahun 2000, nama sekolah ditetapkan menjadi SMKN 1 Katapang Kabupaten Bandung.',
            'vision' => 'Menjadi sekolah menengah kejuruan sebagai pusat penyiapan generasi yang unggul, berkarakter kebangsaan, kompetitif, dan adaptif.',
            'mission' => "Menyelenggarakan pembelajaran inovatif dan profesional.\nMengembangkan sumber daya manusia sesuai perkembangan zaman.\nMembentuk lulusan yang berkarakter, kompetitif, dan peduli terhadap sesama serta lingkungan.",
            'principal_name' => 'Hendra Hermansah',
            'principal_greeting' => 'Selamat datang di website resmi SMKN 1 Katapang. Semoga informasi yang tersedia dapat membantu keluarga dan masyarakat mengenal sekolah kami lebih dekat.',
            'principal_photo' => null,
            'address' => 'Jalan Ceuri Terusan Kopo KM 13,5, Katapang, Kabupaten Bandung, Jawa Barat.',
            'phone' => '(022) 5893737',
            'email' => 'info@smkn1katapang-bdg.sch.id',
            'logo' => null,
        ];
    }
}
