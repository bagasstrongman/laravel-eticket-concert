<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {
            User::factory(10)->create()->each(function ($user) {
                $user->assignRole('user');
            });

            User::create([
                'username' => 'company',
                'email' => 'company@gmail.com',
                'language' => 'id',
                'password' => 'password'
            ])->assignRole('company');

            User::create([
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'language' => 'id',
                'password' => 'password'
            ])->assignRole('admin');

            User::create([
                'username' => 'benjamin4k',
                'email' => 'benjamin@gmail.com',
                'language' => 'id',
                'password' => 'password'
            ])->assignRole('superadmin');
        }
    }
}
