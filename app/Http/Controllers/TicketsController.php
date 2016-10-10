<?php namespace TeachMe\Http\Controllers;

use Illuminate\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TeachMe\Entities\Ticket;
use TeachMe\Entities\TicketComment;
use TeachMe\Repositories\TicketRepository;



class TicketsController extends Controller {

	/* Metodo para optimizar la consulta de los votos y comentarios
	protected function selectTicketsList()
	{
		return Ticket::selectRaw(
			'tickets.*, '
			.'( SELECT COUNT(*) FROM ticket_comments WHERE ticket_comments.ticket_id = tickets.id) as num_comments,'
			.'( SELECT COUNT(*) FROM ticket_votes WHERE ticket_votes.ticket_id = tickets.id) as num_votes'
			)
		->with('author');
	}*/

	public function __construct(TicketRepository $TicketRepository)
	{
		$this->TicketRepository = $TicketRepository;
	}

	public function latest()
	{ 
		$tickets = $this->TicketRepository->paginateLastest();
		 return view('tickets/list', compact('tickets'));
			
		/*Consulta los  ultimos registros y los ordena de forma descendente
		$tickets = $this->selectTicketsList()
		->orderBy('created_at', 'DESC')	
		->paginate(10);*/
		
	}

	public function popular()
	{
		$tickets = $this->TicketRepository->paginatePopulares(); 
		return view('tickets/list', compact('tickets'));
	}

	public function open()
	{
		/* Consulta los registros con status OPEN y los ordena de forma descendente
		$tickets = $this->selectTicketsList()
		->Where('status', 'open')
		->orderBy('created_at', 'DESC')
		->paginate(5);*/
		$tickets = $this->TicketRepository->paginateOpen(); 
		return view('tickets/list', compact('tickets'));
	}

	public function closed()
	{
		/* Consulta los registros con status CLOSED y los ordena de forma descendente
		$tickets = $this->selectTicketsList()
		->Where('status', 'closed')
		->orderBy('created_at', 'DESC')
		->paginate(5);*/
		$tickets = $this->TicketRepository->paginateClosed();
		return view('tickets/list', compact('tickets'));
	}

	public function details($id)
	{
		/*realiza una busqueda por $id
		$ticket = Ticket::findOrFail($id);
		$user = $auth->user();*/

		$ticket = $this->TicketRepository->findOrFail($id);
		return view('tickets/details', compact('ticket'));
	}

	public function create()
	{
		return view('tickets.create');
	}

	public function store(Request $request)
	{
		
		$this->validate($request, [
			'title' => 'required|max:120',
			'link' => 'url',
			]);

		$ticket = $this->TicketRepository->openNew(
			currentUser(),
			$request->get('title'),
			$request->get('link')
			); 
		return Redirect::route('tickets.details', $ticket->id);

		/* Optimizado insertar ticket
		$ticket = $auth->user()->tickets()->create([
			 'title' => $request->get('title'),
			 'status' => 'open'

			]);*/

		/* Insertar un nuevo ticket
		--
		 $ticket = new Ticket();
		$ticket->title = $request->get('title');
		$ticket->status = 'open';
		$ticket->user_id = $auth->user()->id;
		$ticket->save(); */
	}

	public function finish($id, $comment)
	{
	  //Para asignar un Valor a una variable el metodo debe retornar algo a dicha variable
	  //$ticket = $this->TicketRepository->update_status_ticket($id, $comment);
	  $this->authorize('selectResource', $id);
	  $this->TicketRepository->update_status_ticket($id, $comment);  
	  return Redirect::route('tickets.details', $id);
	  //return Redirect::back();
	}



	//

}
