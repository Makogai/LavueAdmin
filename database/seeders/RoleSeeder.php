<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'role_view',
            ],
            [
                'name' => 'role_create',
            ],
            [
                'name' => 'role_update',
            ],
            [
                'name' => 'role_delete',
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
            Role::find(1)->givePermissionTo($permission);
        }
    }
}
