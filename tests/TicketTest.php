<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class TicketTest extends TestCase {

	use DatabaseTransactions;
	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function test_create_ticket()
	{
		//$response = $this->call('GET', '/');
		//$this->assertEquals(200, $response->getStatusCode());
		// Crear un Usuario ---- seed('Ticket');
		$user = seed('User'); 	
		//$this->assertTrue(true);
		
		$this->actingAs($user)
			 ->visit(route('tickets.create'))
			 ->type('Curso de VueJS', 'title')
			 ->press('Enviar Solicitudes');

		$this->see('Curso de VueJS');
		$this->seeInDatabase('tickets', [

			'title' => 'Curso de VueJS',
			'status' => 'open',
			]);

	}

}
