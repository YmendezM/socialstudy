<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use TeachMe\Policies\TicketPolicy;

class TicketPolicyTest extends TestCase
{
	//use DatabaseTransactions;
	public function Test_author_can_select_resource()
	{
		$user = seed('User');
		$ticket = seed('Ticket', [
			'user_id' => $user->id	
			]);
		$policy = new TicketPolicy();

		$this->assertTrue($policy->selectResource($user, $ticket));
	}

	public function test_other_users_cannot_select_resource()
	{
		$user = seed('User');
		$ticket = seed('Ticket', [
				'user_id' => $user->id
			]);

		$otherUser = seed('User');

		$policy = new TicketPolicy();

		$this->assertFalse($policy->selectResource($otherUser, $ticket));

	}

	public function test_prevent_users_for_selecting_a_resource_twice()
	{
		$user = seed('User');
		$ticket = seed('Ticket', [
				'user_id' => $user->id,
				'status' => 'closed',
			]);


		$policy = new TicketPolicy();
		$this->assertFalse($policy->selectResource($user, $ticket));

	}

	public function test_administrators_can_select()
	{
		$user = seed('User');
		$ticket = seed('Ticket',
			[ 
			'user_id' => $user->id,
			]);

		$admin = seed ('User', 
			[
				'role' => 'admin',
			]); 

		$policy = new TicketPolicy();

		$this->assertTrue(Gate::forUser($admin)->allows('selectResource', $ticket));
	}

	public function test_administrador_select_two_resources()
	{
		$user = seed('User', ['role' => 'admin']);
		$ticket = seed('Ticket', ['user_id' => $user->id]);

		$comment1 = seed('TicketComment', 
			['ticket_id' => $ticket->id,
			 'link'      => 'www.gmail.com',	
			]);

		$comment2 = seed('TicketComment', 
			['ticket_id' => $ticket->id,
			 'link'      => 'www.google.com',	
			]);

		$this->actingAs($user)
			 ->visit(route('tickets.details', $ticket))
			 ->press('comment-'. $comment1->id);
		$this->actingAs($user)
			 ->visit(route('tickets.details', $ticket))
			 ->press('comment-'. $comment2->id);


		//$ticket->assignResource($comment1);
		//$ticket->assignResource($comment2);

		$this->seeInDatabase('tickets',[
				'id' => $ticket->id,
				'link' => 'www.google.com'
			]);
		//dd(\TeachMe\Entities\TicketComment::all()->toArray());

			$this->seeInDatabase('ticket_comments',[
				'id' => $comment1->id,
				'selected' => false,
			]);

			$this->seeInDatabase('ticket_comments',[
				'id' => $comment2->id,
				'selected' => true,
			]);

	}
}
