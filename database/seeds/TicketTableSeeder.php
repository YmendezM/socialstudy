<?php

//use Illuminate\Database\Seeder;
//use Illuminate\Database\Eloquent\Model;
use TeachMe\Entities\Ticket;
use Faker\Factory as Faker;
use Faker\Generator;
use Styde\Seeder\Seeder;


class TicketTableSeeder extends Seeder 
{


	public function getModel()
	{

		return new Ticket(); 
	}

	public function getDummyData(Generator $faker, array $customValues = array())
	{

		return [
			'title'     => $faker->sentence(),
			'link'     => $faker->randomElement(['','',$faker->url]),
			'status'    => $faker->randomElement(['open', 'open', 'closed']),
			'user_id' => $this->random('User')->id
			//Asigna solo a un usuario cada nota  $this->createFrom('UserTableSeeder')->id  
			//Genera un rand aleatiorio rand(1,51)
		];


	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */

}
