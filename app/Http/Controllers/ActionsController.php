<?php

namespace App\Http\Controllers;

use App\Action;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActionsController extends Controller
{
    public function store(Request $request, $id)
    {

        $request->validate([
            'content' => 'required',
        ]);

        $ticket = Ticket::findOrFail($id);
        $action = new Action();
        $action->content = $request->get('content');
        $action->from_id = Auth::user()->id;
        $action->ticket()->associate($ticket);
        $action->save();
        return redirect(route('ticket.show', ['id' => $ticket->id]));
    }

    public function destroy(int $action, int $ticket)
    {
        $ticket = Ticket::findOrFail($ticket);
        Message::destroy($action);
        return redirect(route('ticket.show', ['id' => $ticket->id]));
    }
}
