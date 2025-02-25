<?php

namespace Database\Seeders;

use AppHealer\Models\User;
use Faker\Generator;
use Faker\Provider\Internet;
use Faker\Provider\Person;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAndPermissionsSeeder extends Seeder
{
    public function run(): void
	{


		for ($i = 0; $i <= 15; $i++) {
			$generator = new Generator();
			$person = new \Faker\Provider\en_US\Person($generator);
			$name = $person->firstName(mt_rand(0,1) == 0 ? 'male' : 'female') . ' ' . $person->lastName();
			$email = strtolower($name) . '@' . Internet::freeEmailDomain();
			$email = str_replace(' ', '.', $email);
			new  User([
				'email' => $email,
				'name' => $name,
				'blocked' => mt_rand(0,1),
				'password' => Hash::make('password'),
			])->save();
		}
	}
}
