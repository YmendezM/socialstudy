<?php 
namespace TeachMe\Entities;

class Ticket extends Entity {

	protected $table = 'tickets';

    protected $fillable = ['title', 'link', 'status'];

	public function author()
	{
		return $this->belongsTo(User::getClass(), 'user_id');
	}

	public function comments()
	{
		return $this->hasMany(TicketComment::getClass());
	}

	public function voters()
	{
		return $this->belongstoMany(User::getClass(), 'ticket_votes')->withTimestamps();
	}

	public function getOpenAttribute()
	{
		return $this->status == 'open';
	}

	//

}
