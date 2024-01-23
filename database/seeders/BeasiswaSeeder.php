<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Beasiswa;
use App\Models\Kampus;
use App\Models\Jenjang;
use App\Models\Jurusan;
use App\Models\Perusahaan;

class BeasiswaSeeder extends Seeder
{
    /**
 * Run the database seeds.
 */
public function run()
{
    $faker = \Faker\Factory::create();

    // Mendapatkan ID kampus untuk menghubungkan dengan beasiswa
    $kampusIDs = Kampus::pluck('KampusID')->all();

    // Mendapatkan ID perusahaan untuk menghubungkan dengan beasiswa
    $perusahaanIDs = Perusahaan::pluck('PerusahaanID')->all();

    // Mendapatkan ID jenjang untuk menghubungkan dengan beasiswa
    $jenjangIDs = Jenjang::pluck('JenjangID')->all();

    // Mendapatkan ID jurusan untuk menghubungkan dengan beasiswa
    $jurusanIDs = Jurusan::pluck('JurusanID')->all();

    for ($i = 1; $i <= 1; $i++) {
        $tipeBeasiswa = $faker->randomElement(['Kampus', 'Non-Kampus']);
        $perusahaanID = null;
        $kampusID = null;
    
        if ($tipeBeasiswa === 'Kampus') {
            $kampusID = $faker->randomElement($kampusIDs);
        } else {
            $perusahaanID = $faker->randomElement($perusahaanIDs);
        }
    
        $beasiswa = Beasiswa::create([
            'NamaBeasiswa' => $faker->sentence,
            'Deskripsi' => $faker->paragraph,
            'Persyaratan' => $faker->paragraph,
            'TanggalPendaftaran' => $faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
            'TanggalPenutupan' => $faker->dateTimeBetween('+1 month', '+3 months')->format('Y-m-d'),
            'TahunMasuk' => $faker->year,
            'Pembiayaan' => $faker->word,
            'JumlahPenerima' => $faker->numberBetween(1, 10),
            'Kontak' => $faker->phoneNumber,
            'TipeBeasiswa' => $tipeBeasiswa,
            'KampusID' => $kampusID,
            'PerusahaanID' => $perusahaanID,
        ]);
    
        // Menambahkan hubungan beasiswa dengan jenjang (lebih dari satu jenjang)
        for ($j = 1; $j <= $faker->numberBetween(1, 2); $j++) {
            $beasiswa->jenjang()->attach($faker->randomElement($jenjangIDs));
        }
    
        // Menambahkan hubungan beasiswa dengan jurusan (lebih dari satu jurusan)
        for ($k = 1; $k <= $faker->numberBetween(1, 6); $k++) {
            $beasiswa->jurusan()->attach($faker->randomElement($jurusanIDs));
        }
    
        $beasiswa->save();
    }
    
}

}
