<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Permission;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            'admin' => User::create([
                'username'          => 'admin',
                'email'             => 'admin@example.com',
                'password'          => Hash::make('root'),
                'email_verified_at' => now(),
            ]),
            'superadmin' => User::create([
                'username'          => 'super',
                'email'             => 'superadmin@example.com',
                'password'          => Hash::make('root'),
                'email_verified_at' => now(),
            ]),
            'moderator' => User::create([
                'username'          => 'moderator',
                'email'             => 'moderator@example.com',
                'password'          => Hash::make('root'),
                'email_verified_at' => now(),
            ]),
        ];

        $users['superadmin']->assignRole(Role::DEVELOPER);
        $users['admin']->assignRole(Role::ADMIN);
        $users['moderator']->assignRole(Role::MODERATOR);
    }
}
