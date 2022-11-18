<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        if (Role::count() == 0) {
            foreach (config()->get('role.seeder.list') as $role) {
                $permission = [];

                if (config()->has('permission.seeder.role.'.$role)) {
                    $permission = config()->get('permission.seeder.role.'.$role);
                } else {
                    $permission = config()->get('permission.seeder.role.user');
                }

                Role::create([
                    'name' => $role
                ])->syncPermissions($permission);
            }
        }
    }
}
