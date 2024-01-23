<?php

namespace Database\Seeders;
use App\Models\Jenjang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenjangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            [
                'NamaJenjang' => 'SMA',
                'Deskripsi' => 'Sekolah Menengah Atas',
            ],
            [
                'NamaJenjang' => 'SMK',
                'Deskripsi' => 'Sekolah Menengah Kejuruan',
            ],
        ];

        foreach ($data as $item) {
            Jenjang::create($item);
        }
    }
}
