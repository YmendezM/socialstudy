<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use database\seeds\UserTableSeeder;
use Styde\Seeder\BaseSeeder;

class DatabaseSeeder extends BaseSeeder {

	protected $truncate = array(
			'users', 
			'tickets',
		    'ticket_votes',
		    'ticket_comments',

		);

	protected $seeders = array(

			'User',
			'Ticket',
			'TicketVote',
			'TicketComment',
		);

	/**
	 * Run the database seeds.
	 *
	 * @return void
	
	public function run()
	{
		Model::unguard();

		 $this->truncateTables(array('users', 'tickets', 'ticket_votes', 'ticket_comments'));	
		 $this->call('UserTableSeeder');
		 $this->call('TicketTableSeeder');
		 $this->call('TicketVoteTableSeeder');
		 $this->call('TicketCommentTableSeeder');
	}

	private function truncateTables(array $tables){

		$this->checkForignKey(false);

 		foreach ($tables as $table) {
 			DB::table($table)->truncate();
			
 		}

 		$this->checkForignKey(true);
		
	}

	private function checkForignKey($check){

		$check = $check ? '1':'0'; 
		DB::statement('SET FOREIGN_KEY_CHECKS ='.$check);
		//Se desactiva las claves Foreign_Key

	}*/

}
