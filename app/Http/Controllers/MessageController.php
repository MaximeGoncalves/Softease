<?php

namespace App\Http\Controllers;

use App\Message;
use App\Notifications\NewMessage;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(Request $request, $id)
    {

        $request->validate([
            'content' => 'required',
        ]);

        $ticket = Ticket::findOrFail($id);
        $message = new Message();
        $message->content = $request->get('content');
        $message->from_id = Auth::user()->id;
        if (Auth::user()->id == $ticket->user->id):
            $message->to_id = 1;
        else:
            $message->to_id = $ticket->user->id;
        endif;
        $message->ticket()->associate($ticket);
        $message->save();
        $user = User::find($message->to_id);
        if($user->id !== 1){
        $softease = User::find(1);
        $softease->notify(new NewMessage($message, $ticket));
        }
        $user->notify(new NewMessage($message, $ticket));
        return redirect(route('ticket.show', ['id' => $ticket->id]));
    }

    public function destroy(int $message, int $ticket)
    {
        $ticket = Ticket::findOrFail($ticket);
        Message::destroy($message);
        return redirect(route('ticket.show', ['id' => $ticket->id]));
    }
}
