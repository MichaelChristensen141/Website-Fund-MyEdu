<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        foreach ($data as $item) {
            Permission::firstOrCreate([
                'name'          => $item,
                'guard_name'    => 'web',
            ]);
        }
    }
}
