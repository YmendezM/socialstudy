<?php namespace TeachMe\Http\Controllers;

use Illuminate\Auth\Guard;
use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TeachMe\Entities\Ticket;
use TeachMe\Entities\TicketComment;
use TeachMe\Repositories\TicketRepository;
use TeachMe\Repositories\CommentRepository;



class CommentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	protected $ticketRepository;
	protected $commentRepository;

	public function __construct(
		TicketRepository $ticketRepository,
		CommentRepository $commentRepository)
	{
		$this->commentRepository = $commentRepository;
		$this->ticketRepository = $ticketRepository;
	}


	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request, $id, Guard $auth)
	{
		$this->validate($request,[
				'comment' => 'required|max:250',
				'link'=> 'url'

			]);

		$ticket = $this->ticketRepository->findOrFail($id);
		 

		$this->commentRepository->create(
			$ticket, 
			currentUser(), 
			$request->get('comment'),
			$request->get('link') 
			); 
		session()->flash('success', 'Tu comentario fue guardado Exitosamente '); 
		return redirect()->back(); 

		/* Creacion de comentario
		$comment = new TicketComment($request->only(['comment', 'link']));
		$comment->user_id = $auth->id(); 
		$ticket = Ticket::findOrFail($id); 
		$ticket->comments()->save($comment);

		session()->flash('success', 'Tu comentario fue guardado Exitosamente '); 
		return redirect()->back(); */

		/*TicketComment::create([
            'comment' => $request['comment'],
            'link' => $request['link'],
            'user_id' => $user,
            'ticket_id' => $id,
        ]);
        return redirect()->to('tickets.details');*/
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
