<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Jurusan;
use App\Models\Jenjang;
use App\Models\Verifikasi;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'NamaDepan'     => 'Admin',
                'NamaBelakang'  => 'Admin',
                'email'         => 'admin@mail.com',
                'password'      => 'admin',
                'roles'         => ['admin'],
            ],
            [
                'NamaDepan'     => 'User',
                'NamaBelakang'  => 'Admin',
                'email'         => 'user@mail.com',
                'password'      => 'user',
                'roles'         => ['user'],
            ]
        ];

        foreach ($data as $item) {
            $user = User::firstOrCreate([
                'NamaDepan'              => $item['NamaDepan'],
                'NamaBelakang'              => $item['NamaBelakang'],
                'email'             => $item['email'],
                'password'          => Hash::make($item['password']),
                'email_verified_at' => now(),
            ]);

            $user->syncRoles($item['roles']);
        }
        
        $faker = Faker::create('id_ID');
        
        $fakerJurusanIDs = Jurusan::pluck('JurusanID')->all();
        $fakerJenjangIDs = Jenjang::pluck('JenjangID')->all();

        

        for ($i = 0; $i < 10; $i++) {
            $isFilled = $faker->boolean;
            $isFilledStatus = $faker->boolean;
            $createdAt = $faker->dateTimeBetween('-2 years', 'now');
        
            $userFields = [
                'NamaDepan' => $faker->firstName,
                'NamaBelakang' => $faker->lastName,
                'email' => $faker->unique()->email,
                'password' => Hash::make('password'),
                'email_verified_at' => $createdAt,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        
            if ($isFilled) {
                $userFields['TanggalLahir'] = $faker->date('Y-m-d');
                $userFields['Alamat'] = $faker->address;
                $userFields['JurusanID'] = $faker->randomElement($fakerJurusanIDs);
                $userFields['JenjangID'] = $faker->randomElement($fakerJenjangIDs);
                $userFields['NilaiRata'] = $faker->randomFloat(2, 0, 100);
                $userFields['PekerjaanOrtu'] = $faker->jobTitle;
                $userFields['TahunLulus'] = $faker->numberBetween(2017, 2023);
                $userFields['PendapatanOrtu'] = $faker->numberBetween(1000, 100000);
                $userFields['RiwayatPrestasi'] = $faker->sentence(3);

                if ($isFilledStatus) {
                    $userFields['Status'] = 'aktif';
                }
                
            }
        
            $user = User::create($userFields);
            $user->syncRoles('user');
        
            if ($isFilled) {
                if ($isFilledStatus) {
                    $catatan = 'Verifikasi berhasil';
                    $status = 'approved';
                } else {
                    $catatan = 'Menunggu persetujuan dari admin';
                    $status = 'pending';
                }
                Verifikasi::create([
                    'user_id' => $user->id,
                    'status' => $status, 
                    'catatan' => $catatan,
                ]);
            }
        }


    }
}
