<?php

namespace Database\Seeders;

use App\Models\Links;
use Illuminate\Database\Seeder;

class LinksSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            ['nama' => 'e-Mail Kemendikdasmen',       'url' => 'https://mail.kemdikbud.go.id/',                          'is_active' => true],
            ['nama' => 'Portal Data Kemendikdasmen',  'url' => 'https://data.kemendikdasmen.go.id/',                     'is_active' => true],
            ['nama' => 'Rumah Pendidikan',            'url' => 'https://rumah.pendidikan.go.id/',                        'is_active' => true],
            ['nama' => 'SIPdasmen',                   'url' => 'https://data-sdm.kemdikbud.go.id/',                     'is_active' => true],
            ['nama' => 'Dapodik',                     'url' => 'https://dapo.kemendikdasmen.go.id/',                     'is_active' => true],
            ['nama' => 'Info GTK',                    'url' => 'https://info.gtk.kemendikdasmen.go.id/',                 'is_active' => true],
            ['nama' => 'Rapor Pendidikan',            'url' => 'https://raporpendidikan.kemendikdasmen.go.id/login',     'is_active' => true],
            ['nama' => 'SINDE',                       'url' => 'https://sinde.kemendikdasmen.go.id/',                    'is_active' => true],
            ['nama' => 'e-SKP',                       'url' => 'https://skp.sdm.kemdikbud.go.id/skp/site/login.jsp',    'is_active' => true],
        ];

        foreach ($links as $link) {
            Links::firstOrCreate(['url' => $link['url']], $link);
        }
    }
}
