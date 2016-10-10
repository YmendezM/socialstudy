<?php

//use Illuminate\Database\Seeder;
//use Illuminate\Database\Eloquent\Model;
use TeachMe\Entities\TicketComment;
use Faker\Factory as Faker;
use Faker\Generator;
use Styde\Seeder\Seeder;


class TicketCommentTableSeeder extends Seeder 
{


	public function getModel()
	{

		return new TicketComment(); 
	}

	public function getDummyData(Generator $faker, array $customValues = array())
	{

		return [
			'user_id' => $this->random('User')->id,
			'ticket_id' => $this->random('Ticket')->id,
			'comment' => $faker->paragraph(),
			'link' => $faker->randomElement(['','',$faker->url])
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
