<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name'        => 'admin',
                'permissions' => []
            ],
            [
                'name'          => 'user',
                'permissions'   => []
            ]
        ];

        foreach ($data as $item) {
            $role = Role::firstOrCreate([
                'name'          => $item['name'],
                'guard_name'    => 'web',
            ]);

            $role->syncPermissions($item['permissions']);
        }
    }
}
