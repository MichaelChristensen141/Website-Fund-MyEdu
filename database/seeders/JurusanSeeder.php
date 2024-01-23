<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jenjang;
use App\Models\Jurusan;
class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        // Mendapatkan ID jenjang "SMA" dari tabel "jenjang"
        $jenjangSMA = Jenjang::where('NamaJenjang', 'SMA')->first()->JenjangID;

        // Mendapatkan ID jenjang "SMK" dari tabel "jenjang"
        $jenjangSMK = Jenjang::where('NamaJenjang', 'SMK')->first()->JenjangID;

        // Data jurusan untuk jenjang SMA
        $dataSMA = [
            [
                'NamaJurusan' => 'IPA',
                'Deskripsi' => 'Ilmu Pengetahuan Alam',
                'JenjangID' => $jenjangSMA,
            ],
            [
                'NamaJurusan' => 'IPS',
                'Deskripsi' => 'Ilmu Pengetahuan Sosial',
                'JenjangID' => $jenjangSMA,
            ],
        ];

        $dataSMK = [
            [
                'NamaJurusan' => 'Teknik Informatika',
                'Deskripsi' => 'Jurusan Teknik Informatika',
                'JenjangID' => $jenjangSMK,
            ],
            [
                'NamaJurusan' => 'Akuntansi',
                'Deskripsi' => 'Jurusan Akuntansi',
                'JenjangID' => $jenjangSMK,
            ],
            [
                'NamaJurusan' => 'Teknik Mesin',
                'Deskripsi' => 'Jurusan Teknik Mesin',
                'JenjangID' => $jenjangSMK,
            ],
            [
                'NamaJurusan' => 'Teknik Elektro',
                'Deskripsi' => 'Jurusan Teknik Elektro',
                'JenjangID' => $jenjangSMK,
            ],
            [
                'NamaJurusan' => 'Multimedia',
                'Deskripsi' => 'Jurusan Multimedia',
                'JenjangID' => $jenjangSMK,
            ],
            [
                'NamaJurusan' => 'Desain Grafis',
                'Deskripsi' => 'Jurusan Desain Grafis',
                'JenjangID' => $jenjangSMK,
            ],
            [
                'NamaJurusan' => 'Kesehatan',
                'Deskripsi' => 'Jurusan Kesehatan',
                'JenjangID' => $jenjangSMK,
            ],
            [
                'NamaJurusan' => 'Perhotelan',
                'Deskripsi' => 'Jurusan Perhotelan',
                'JenjangID' => $jenjangSMK,
            ],
            [
                'NamaJurusan' => 'Bisnis Internasional',
                'Deskripsi' => 'Jurusan Bisnis Internasional',
                'JenjangID' => $jenjangSMK,
            ],
            [
                'NamaJurusan' => 'Pariwisata',
                'Deskripsi' => 'Jurusan Pariwisata',
                'JenjangID' => $jenjangSMK,
            ],
            [
                'NamaJurusan' => 'Farmasi',
                'Deskripsi' => 'Jurusan Farmasi',
                'JenjangID' => $jenjangSMK,
            ],
            [
                'NamaJurusan' => 'Tata Boga',
                'Deskripsi' => 'Jurusan Tata Boga',
                'JenjangID' => $jenjangSMK,
            ],
            [
                'NamaJurusan' => 'Otomotif',
                'Deskripsi' => 'Jurusan Otomotif',
                'JenjangID' => $jenjangSMK,
            ],
            [
                'NamaJurusan' => 'Desain Interior',
                'Deskripsi' => 'Jurusan Desain Interior',
                'JenjangID' => $jenjangSMK,
            ],
            [
                'NamaJurusan' => 'Kriya Tekstil',
                'Deskripsi' => 'Jurusan Kriya Tekstil',
                'JenjangID' => $jenjangSMK,
            ],
            [
                'NamaJurusan' => 'Pemasaran',
                'Deskripsi' => 'Jurusan Pemasaran',
                'JenjangID' => $jenjangSMK,
            ],
            [
                'NamaJurusan' => 'Komputer Jaringan',
                'Deskripsi' => 'Jurusan Komputer Jaringan',
                'JenjangID' => $jenjangSMK,
            ],
            [
                'NamaJurusan' => 'Teknik Pendingin',
                'Deskripsi' => 'Jurusan Teknik Pendingin',
                'JenjangID' => $jenjangSMK,
            ],
            [
                'NamaJurusan' => 'Keperawatan',
                'Deskripsi' => 'Jurusan Keperawatan',
                'JenjangID' => $jenjangSMK,
            ],
            [
                'NamaJurusan' => 'Tata Busana',
                'Deskripsi' => 'Jurusan Tata Busana',
                'JenjangID' => $jenjangSMK,
            ],
        ];
        

        foreach ($dataSMA as $item) {
            Jurusan::create($item);
        }

        foreach ($dataSMK as $item) {
            Jurusan::create($item);
        }
    }
}
