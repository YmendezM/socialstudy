<?php namespace TeachMe\Http\Controllers;

use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;
use TeachMe\Entities\Ticket;
use TeachMe\Repositories\TicketRepository;
use TeachMe\Repositories\VoteRepository;
use Illuminate\Http\Request;

class VoteController extends Controller {

		private $ticketRepository;
		private $voteRepository;

		public function __construct(

			TicketRepository $ticketRepository,
			VoteRepository $voteRepository 
			)
		{
			$this->ticketRepository = $ticketRepository;
			$this->voteRepository = $voteRepository;
		}

		public function submit($id, Request $request)
		{
			$ticket = $this->ticketRepository->findOrFail($id);
			$success = $this->voteRepository->vote(currentUser(), $ticket); 
			
			if($request->ajax())
			{
				return response()->json(compact('success'));
			}

			return redirect()->back();
		}

		public function destroy($id, Request $request)
		{
			$ticket = $this->ticketRepository->findOrFail($id);
			$success = $this->voteRepository->unvote(currentUser(), $ticket); 
			
			if($request->ajax())
			{
				return response()->json(compact('success'));
			}

			return redirect()->back(); 
		}
}
