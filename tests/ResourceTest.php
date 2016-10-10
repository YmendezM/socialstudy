<?php

//use Illuminate\Foundation\Testing\DatabaseTransactions;

class ResourceTest extends TestCase {

	//use DatabaseTransactions;

	protected $title = 'Curso de interfaces dinámicas con Laravel y jQuery';
	protected $link = 'https://styde.net/curso-de-interfaces-dinamicas-con-laravel-y-jquery/';
	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function test_create_resource()
	{
		//$response = $this->call('GET', '/');
		//$this->assertEquals(200, $response->getStatusCode());
		// Crear un Usuario ---- seed('Ticket');
		$user = seed('User'); 	
		//$this->assertTrue(true);
		
		$this->actingAs($user)
			 ->visit(route('tickets.create'))
			 ->type($this->title, 'title')
			 ->type($this->link, 'link')
			 ->press('Enviar Solicitudes');

		$this->seeInDatabase('tickets', [

			'title' => $this->title,
			'link' => $this->link,
			'status' => 'closed',
			]);	 

		$this->see($this->title)
			 ->seeLink('Ver recurso', $this->link);	



	}

	public function test_select_resource()
	{
		$user = seed('User');
		$ticket = seed('Ticket', [
			'title' => $this->title,
			'user_id' => $user->id,
			'status' => 'open',
			]); 

		$comment = seed('TicketComment',
			[ 'ticket_id' => $ticket->id,
			  'link' => $this->link, 
			]);

		$this->actingAs($user)
			->visit(route('tickets.details', $ticket))
			->press('Seleccionar Tutorial');

		$this->seeInDatabase('tickets',
			[ 'id' => $ticket->id,
			  'status' => 'closed',
			  'link' => $this->link,
			]);

		$this->seeInDatabase('ticket_comments',[
				'id' => $comment->id,
				'selected' => true,
			]);

		$this->seePageIs(route('tickets.details', $ticket));

		$this->seeLink('Ver recurso', $this->link);
	}

}
