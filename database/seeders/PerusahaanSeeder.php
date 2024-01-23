<?php

namespace Database\Seeders;
use App\Models\Perusahaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 500; $i++) {
            Perusahaan::create([
                'NamaPerusahaan' => $faker->company,
                'Alamat' => $faker->address,
                'Kontak' => $faker->phoneNumber,
                'Website' => $faker->url,
            ]);
        }
    }
}
