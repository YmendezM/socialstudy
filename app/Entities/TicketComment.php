<?php namespace TeachMe\Entities;


class TicketComment extends Entity {

	protected $table = 'ticket_comments';

    protected $fillable = ['comment','link','selected','user_id', 'ticket_id'];



	public function ticket()
	{
		return $this->belongstTo(Ticket::getClass()); 
	}

	public function user()
	{
		return $this->belongsTo(User::getClass()); 
	}

	//

}
