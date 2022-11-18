<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Permission::count() == 0) {
            app()[PermissionRegistrar::class]->forgetCachedPermissions();

            foreach (config()->get('permission.seeder.list') as $permission) {
                Permission::create([
                    'name' => $permission
                ]);
            };
        }
    }
}
