<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MoreUsersSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        $faker = Faker::create('fr_FR');

        for ($i = 1; $i <= 89; $i++) {
            $u1 = new User();

            $u1->username = $faker->userName;
            $u1->email = $faker->email;
            $u1->firstname = $faker->firstName;
            $u1->lastname = $faker->lastName;
            $u1->password = Hash::make('root');
            $u1->created_at = $faker->dateTimeBetween('2021-01-01', '2021-12-31')->format('Y-m-d H:i:s');
            $u1->email_verified_at = $faker->boolean(50) ? $faker->dateTimeBetween('2021-01-01', '2021-12-31')->format('Y-m-d H:i:s') : null;
            $u1->active = 1;

            $u1->save();
        }
	}
}
