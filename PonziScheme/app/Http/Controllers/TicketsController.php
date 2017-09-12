<?php

namespace App\Http\Controllers;

use App\category;
use App\Mailers\AppMailer;
use App\ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{

    public function Index()
    {
        $tickets = ticket::paginate(10);
        $categories = category::all();
        $title = 'Tickets - Admin';
        return view('ticket.index', compact('tickets', 'categories','title'));
    }
    public function Create()
    {
        return view('ticket.create')->with(['title' => 'Create Ticket',
            'cat'=>category::all()]);
    }

    public function Store(Request $request, AppMailer $mailer)
    {
        //dd($request->all());
        $this->validate($request, [
            'title'     => 'required',
            'category'  => 'required',
            'priority'  => 'required',
            'message'   => 'required'
        ]);

        $ticket = new ticket([
            'title'     => $request->input('title'),
            'user_id'   => Auth::user()->id,
            'ticket_id' => strtoupper(str_random(10)),
            'category_id'  => $request->input('category'),
            'priority'  => $request->input('priority'),
            'message'   => $request->input('message'),
            'status'    => "Open",
        ]);

        $ticket->save();

        $mailer->sendTicketInformation(Auth::user(), $ticket);

        return redirect()->back()->with("status", "A ticket with ID: #$ticket->ticket_id has been opened.");
    }

    public function UserTickets()
    {
        $tickets = ticket::where('user_id', Auth::user()->id)->paginate(10);
        $categories = category::all();
        $title = 'Tickets';
        return view('ticket.user_ticket', compact('tickets', 'categories','title'));
    }

    public function show($t_id)
    {
        $ticket = ticket::where('ticket_id', $t_id)->firstOrFail();

        $comments = $ticket->comments;

        $category = $ticket->category;

        $title = 'Show Ticket';
        return view('ticket.show', compact('ticket', 'category', 'comments','title'));
    }

    public function close($ticket_id, AppMailer $mailer)
    {
        $ticket = ticket::where('ticket_id', $ticket_id)->firstOrFail();

        $ticket->status = 'Closed';

        $ticket->save();

        $ticketOwner = $ticket->user;

        $mailer->sendTicketStatusNotification($ticketOwner, $ticket);

        return redirect()->back()->with("status", "The ticket has been closed.");
    }


}
