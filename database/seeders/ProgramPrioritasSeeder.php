<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgramPrioritas;

class ProgramPrioritasSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'nama_program' => 'Program Pembelajaran Mendalam (PM)',
                'url'          => '/program/ppm',
                'gambar'       => '/images/assets/program/pm.png',
                'is_active'    => true,
            ],
            [
                'nama_program' => 'Koding dan Kecerdasan Artifisial (KKA)',
                'url'          => '/program/kka',
                'gambar'       => '/images/assets/program/kka.png',
                'is_active'    => true,
            ],
            [
                'nama_program' => 'Program Pendidikan Profesi Guru (PPG)',
                'url'          => '/program/ppg',
                'gambar'       => '/images/assets/program/ppg.png',
                'is_active'    => true,
            ],
            [
                'nama_program' => 'Program Pengembangan Keprofesian Guru (PKG) - Bahasa Inggris',
                'url'          => '/program/pkb',
                'gambar'       => '/images/assets/program/pkg-bi.png',
                'is_active'    => true,
            ],
            [
                'nama_program' => 'Program Pengembangan Keprofesian Guru (PKG) - Bimbingan Konseling',
                'url'          => '/program/pkm',
                'gambar'       => '/images/assets/program/pkg-bk.png',
                'is_active'    => true,
            ],
            [
                'nama_program' => 'Program Bakal Calon Kepala Sekolah (BCKS)',
                'url'          => '/program/bcks',
                'gambar'       => '/images/assets/program/bcks.png',
                'is_active'    => true,
            ],
        ];

        foreach ($programs as $program) {
            ProgramPrioritas::firstOrCreate(
                ['nama_program' => $program['nama_program']],
                $program
            );
        }
    }
}
