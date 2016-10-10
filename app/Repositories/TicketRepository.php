<?php 

namespace TeachMe\Repositories;
use TeachMe\Entities\Ticket;
use TeachMe\Entities\TicketComment;

class TicketRepository extends  BaseRepository
{

	public function getModel()
	{
		return new Ticket();
	}

	protected function getCountTicketComment(){

		return'( SELECT COUNT(*) FROM ticket_comments WHERE ticket_comments.ticket_id = tickets.id)';
	}

	protected function getCountTicketVote(){

		return '( SELECT COUNT(*) FROM ticket_votes WHERE ticket_votes.ticket_id = tickets.id)';
	}

	protected function selectTicketsList()
	{
		return Ticket::selectRaw(
			'tickets.*, '
			. $this->getCountTicketComment() .  'as num_comments,'
			. $this->getCountTicketVote() . 'as num_votes'
			)
		->with('author');
	}


	public function paginateLastest()
	{

		return $this->selectTicketsList()
		->orderBy('created_at', 'DESC')	
		->paginate(10);

	} 

	public function paginatePopulares()
	{
		
		/*dd($this->selectTicketsList()
		->having('num_votes', '>=', '10')
		->orderBy('num_votes', 'DESC')	
		->get()->toArray());*/

		return $this->selectTicketsList()
		->orderBy('created_at', 'DESC')
		->WhereRaw($this->getCountTicketVote(). '>= 10')
		->paginate(20);
	}

	public function paginateOpen()
	{
		return $this->selectTicketsList()
		->Where('status', 'open')
		->orderBy('created_at', 'DESC')
		->paginate(5);
	}

	public function paginateClosed()
	{
		return $this->selectTicketsList()
		->Where('status', 'closed')
		->orderBy('created_at', 'DESC')
		->paginate(5);
	}
	/* Se mueve al BaseRepository
	public function findOrFail($id, $auth)
	{
		return Ticket::findOrFail($id);
		$user = $auth->user();
	}*/

	public function openNew($user, $title, $link='')
	{
			return $user->tickets()->create([
			 'title' => $title,
			 'link' => $link,
			 'status' => $link ? 'closed':'open'

			]);

	}

	public function update_status_ticket($id, $comment)
	{
		//Actualizacion de status Ticket
		//Actulizacion del Comment
		$ticket = Ticket::findOrFail($id);
		$commentsTrue = TicketComment::Where('user_id', $id)
						->Where('selected', true)
						->update(['selected' => false]);
		$comments = TicketComment::findOrFail($comment);				
		$ticket->status = 'closed';
		$ticket->link = $comments->link;
		$ticket->save();
		// Se Utiliza el metodo comments para actualizar solo los comentarios asociados al ticket
		//$this->comments()->where('selected', true)->update(['selected' => false]);
		$comments->selected = true;
		$comments->save();
	}


}
	