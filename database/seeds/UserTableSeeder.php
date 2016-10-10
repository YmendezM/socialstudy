<?php

//use Illuminate\Database\Seeder;
//use Illuminate\Database\Eloquent\Model;
use TeachMe\Entities\User;
use Faker\Factory as Faker;
use Faker\Generator;
use Styde\Seeder\Seeder;


class UserTableSeeder extends Seeder 
{


	public function getModel()
	{

		return new User(); 
	}

	public function getDummyData(Generator $faker, array $customValues = array())
	{

		return [
			'name'     => $faker->name,
			'email'    => $faker->email,
			'password' => bcrypt('admin'),
			'role' 	   => 'user'
 		];


	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->createAdmin();
		$this->createMultiple(50);	
	}

	private function createAdmin()
	{
		$this->create([
			'name'     => 'ysrael Mendez',
			'email'    => 'speiden@hotmail.com',
			'password' => bcrypt('1234'),
			'role' 	   => 'admin'
		]);

	}

}
