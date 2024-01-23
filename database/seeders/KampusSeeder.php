<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kampus;
class KampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        Kampus::create([
            'NamaKampus' => 'Telkom University',
            'Alamat' => $faker->address,
            'Kontak' => $faker->phoneNumber,
            'Website' => $faker->url,
        ]);

        Kampus::create([
            'NamaKampus' => 'Universitas Bina Nusantara',
            'Alamat' => $faker->address,
            'Kontak' => $faker->phoneNumber,
            'Website' => $faker->url,
        ]);

        Kampus::create([
            'NamaKampus' => 'Universitas Katolik Parahyangan',
            'Alamat' => $faker->address,
            'Kontak' => $faker->phoneNumber,
            'Website' => $faker->url,
        ]);
        Kampus::create([
            'NamaKampus' => 'Universitas Kristen Maranatha',
            'Alamat' => $faker->address,
            'Kontak' => $faker->phoneNumber,
            'Website' => $faker->url,
        ]);

        Kampus::create([
            'NamaKampus' => 'Institut Teknologi Bandung',
            'Alamat' => $faker->address,
            'Kontak' => $faker->phoneNumber,
            'Website' => $faker->url,
        ]);

        for ($i = 1; $i <= 500; $i++) {
            Kampus::create([
                'NamaKampus' => $faker->unique()->company . ' University',
                'Alamat' => $faker->address,
                'Kontak' => $faker->phoneNumber,
                'Website' => $faker->url,
            ]);
        }
    }
}
