<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PopularTicketsTest extends TestCase
{
	//use DatabaseTransactions; 
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_seed_popular_Tickets()
    {
    	$popularTicket = seed('Ticket', ['title' => 'Ticket Muy Popoular']);
    	$ticket = seed('Ticket',  ['title' => 'Ticket NO Popoular']);

    	seed('TicketVote', 10, ['ticket_id' => $popularTicket->id]);
    	seed('TicketVote', 2, ['ticket_id' => $ticket->id]);



        $this->visit('/')
        	 ->click('Populares')
        	 ->seeInElement('h1','Solicitudes')
        	 ->see($popularTicket->title)
        	 ->see('10 votos')
        	 ->dontSee($ticket->title)
        	 ->dontSee('2 votos');
    }
}
