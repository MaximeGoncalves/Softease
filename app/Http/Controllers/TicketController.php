<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Message;
use App\Notifications\NewTickets;
use App\Role;
use App\Society;
use App\Source;
use App\Ticket;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Couchbase\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class TicketController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:view,ticket')->except(['index', 'view', 'create', 'store', 'destroy', 'update']);
        Carbon::setLocale(Config::get('app.locale'));
        Carbon::setToStringFormat('d/m/Y à H:i:s');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->get('search')) {
            $user = Auth::user();
            if ($user->hasRole('ROLE_ADMIN') || $user->hasRole('ROLE_TECHNICIAN')) :
                $search = $request->get('search');
                $tickets = Ticket::with('users')->where('topic', 'LIKE', '%' . $search . '%')->orderBy('id')->get();
                return view('admin.tickets.index', compact('tickets'));
            endif;
            $search = $request->get('search');
            $tickets = Ticket::where('topic', 'LIKE', '%' . $search . '%')->where('user_id', $user->id)->orderBy('id')->get();
            return view('admin.tickets.index', ['tickets' => $tickets]);
        }
        $user = Auth::user();
        //Si admin alors
        if ($user->hasRole('ROLE_ADMIN') || $user->hasRole('ROLE_TECHNICIAN')) :
            $tickets = Ticket::with('user')->get();
            return view('admin.tickets.index', compact('tickets'));
        endif;

        //Si User alors
        $tickets = Ticket::with('user')->where('user_id', $user->id)->get();
        return view('admin.tickets.indexUser', compact(['tickets', 'user']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $ticket = new Ticket();
        $ticket->topic = $request->topic;
        $ticket->description = $request->description;
        $ticket->importance = $request->importance;
        $ticket->user()->associate(Auth::user()->id);
        $ticket->save();

        if ($request->pj):
            $pathSociety = $ticket->user->society->name;

            if (!file_exists(public_path() . '/app/SfTicket' . '/' . $pathSociety)):
                mkdir(public_path() . '/app/SfTicket' . '/' . $pathSociety, 0777, true);
            endif;

            mkdir(public_path() . '/app/SfTicket' . '/' . $pathSociety . '/' . $ticket->id, 0777, true);
            $destinationPath = public_path() . '/app/SfTicket' . '/' . $pathSociety . '/' . $ticket->id;

            $files = $request->file('pj');
            if ($request->hasFile('pj')):
                foreach ($files as $file):
                    $file->move($destinationPath, '/' . $file->getClientOriginalName());
                    $pj = new Attachment();
                    $pj->name = $file->getClientOriginalName();
                    $pj->link = '/app/SfTicket/' . $pathSociety . '/' . $ticket->id . '/' . $file->getClientOriginalName();
                    $pj->ticket()->associate($ticket);
                    $pj->save();
                endforeach;
            endif;
        endif;

        $user = User::find(1);
        $user->notify(new NewTickets($ticket));
        Session::flash('success', 'Le ticket à été créer, merci.');
        return redirect(route('ticket.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {

        $admins = User::where('society_id', 1)->get();
        $source = Source::get();
        $sources = $source->pluck('name', 'id');
        $files = Attachment::where('ticket_id', $ticket->id)->get();
        $messages = Message::where('ticket_id', $ticket->id)->latest()->simplePaginate(5);
        return view('admin.tickets.show', compact(['ticket', 'messages', 'admins', 'sources', 'files']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        $ticket->technician_id = $request->technician;
        $ticket->state = $request->state;
        $ticket->source()->associate($request->source);
        $ticket->save();
        Session::flash('success', 'Le ticket à été mis à jour.');
        return redirect(route('ticket.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
