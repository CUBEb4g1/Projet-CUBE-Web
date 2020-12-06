<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Reset cached roles and permissions
		app()['cache']->forget('spatie.permission.cache');

		// === ROLES ===

		$roles = [
			'dev'   => Role::create(['name' => Role::DEVELOPER, 'readable_name' => 'Développeur']),
			'admin' => Role::create(['name' => Role::ADMIN, 'readable_name' => 'Administrateur']),
		];

		// === PERMISSIONS ===

		$permissions = [
			'dev'         => Permission::create(['name' => Permission::DEV, 'readable_name' => 'Accès aux outils de dev.']),
			'switch-auth' => Permission::create(['name' => Permission::SWITCH_AUTH, 'readable_name' => 'Accès aux comptes utilisateurs']),
			'back'        => Permission::create(['name' => Permission::ACCESS_BACKOFFICE, 'readable_name' => 'Accès au backoffice']),
		];

		// === USERS ===

		$users = [
			'admin' => User::create([
				'username'          => 'admin',
				'email'             => 'admin@example.com',
				'password'          => Hash::make('root'),
				'email_verified_at' => now(),
			]),
		];

		// === RELATION DES ROLES & PERMISSIONS ===

		$roles['dev']->syncPermissions([
			Permission::DEV,
			Permission::SWITCH_AUTH,
			Permission::ACCESS_BACKOFFICE,
		]);
		$roles['admin']->syncPermissions([
			Permission::SWITCH_AUTH,
			Permission::ACCESS_BACKOFFICE,
		]);

		// === RELATION DES ROLES & USERS ===

		$users['admin']->assignRole(Role::DEVELOPER);
	}
}
