<?php

namespace App\Http\Controllers;

use App\Action;
use App\Attachment;
use App\Message;
use App\Notifications\CloseTicket;
use App\Notifications\NewTickets;
use App\Role;
use App\Society;
use App\Source;
use App\Technician;
use App\Ticket;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
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
        $technicians = Technician::all();
        $user = User::with(['roles'])->where('id', Auth::user()->id)->first();
        $sort = $request->get('sort');
        $technician = $request->get('technician');

        if ($request->sort == 0):
            $request->session()->put('sort', 0);
        else:
            $request->session()->put('sort', $request->sort);
        endif;


        if ($request->technician == 0):
            $request->session()->put('technician', 0);
        else:
            $request->session()->put('technician', $request->technician);
        endif;


        if ($user->hasRole('ROLE_ADMIN') || $user->hasRole('ROLE_TECHNICIAN')) :
            $k = $sort - 1;
            if ($technician == 0):
                if ($sort == 0):
                    $tickets = Ticket::with(['user', 'society', 'technician', 'source'])->orderBy('created_at', 'desc')->paginate(15);
                    return view('admin.tickets.index', ['tickets' => $tickets, 'technicians' => $technicians]);
                else:
                    $tickets = Ticket::with(['user', 'society', 'technician', 'source'])->where('state', $k)->orderBy('created_at', 'desc')->paginate(15);
                    return view('admin.tickets.index', ['tickets' => $tickets, 'technicians' => $technicians]);
                endif;
            else:
                if ($sort == 0):
                    $tickets = Ticket::with(['user', 'society', 'technician', 'source'])->where('technician_id', $technician)->orderBy('created_at', 'desc')->paginate(15);
                    return view('admin.tickets.index', ['tickets' => $tickets, 'technicians' => $technicians]);
                else:
                    $tickets = Ticket::with(['user', 'society', 'technician', 'source'])->where('state', $k)->where('technician_id', $technician)->orderBy('created_at', 'desc')->paginate(15);
                    return view('admin.tickets.index', ['tickets' => $tickets, 'technicians' => $technicians]);
                endif;
            endif;
        elseif ($user->hasRole('ROLE_LEADER')):
            $k = $sort - 1;
            $tickets = Ticket::with(['user', 'society', 'technician', 'source'])->where('state', $k)->where('society_id', $user->society_id)->orderBy('created_at', 'desc')->paginate(15);
            return view('admin.tickets.index', ['tickets' => $tickets, 'technicians' => $technicians]);
        else:
            if ($sort == 0):
                $tickets = Ticket::with(['user', 'society', 'technician', 'source'])->where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(15);
                return view('admin.tickets.indexUser', ['tickets' => $tickets]);
            else:
                $k = $sort - 1;
                $tickets = Ticket::with(['user', 'society', 'technician', 'source'])->where('state', $k)->where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(15);
                return view('admin.tickets.indexUser', ['tickets' => $tickets, 'technicians' => $technicians]);
            endif;
        endif;


        if ($request->get('search')) :
            $search = $request->get('search');
            if ($user->hasRole('ROLE_ADMIN') || $user->hasRole('ROLE_TECHNICIAN')) :
                $tickets = Ticket::with('user')->where('topic', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'desc')->paginate(15);
                return view('admin.tickets.index', compact('tickets', 'technicians'));
            endif;
            $tickets = Ticket::where('topic', 'LIKE', '%' . $search . '%')->where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(15);
            return view('admin.tickets.index', ['tickets' => $tickets, 'technicians' => $technicians]);
        endif;

        //Si admin alors
        if ($user->hasRole('ROLE_ADMIN') || $user->hasRole('ROLE_TECHNICIAN')) :
            $tickets = Ticket::with('user')->orderBy('created_at', 'desc')->paginate(15);
            return view('admin.tickets.index', compact('tickets', 'technicians'));
        endif;


        //Si user = LEADER
        if ($user->hasRole('ROLE_LEADER')) :
            $users = User::with('society')->where('society_id', $user->society_id)->get();
//            $tickets = [];
//            foreach ($users as $user) {
            $tickets = Ticket::where('society_id', $user->society->id)->orderBy('created_at', 'desc')->paginate(15);
            return view('admin.tickets.index', ['tickets' => $tickets, 'technicians' => $technicians]);
        endif;


        //Si User alors
        $tickets = Ticket::with('user')->where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.tickets.indexUser', compact(['tickets', 'user', 'technicians']));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function create(Request $request)
    {

        $societies = Society::all();
        $users = User::all();
        return view('admin.tickets.create', compact(['societies', 'users']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(Request $request)
    {

        $this->validate($request, [
            'topic' => 'required',
            'description' => 'required',
        ]);
        if ($request->user != 0):
            $user = User::findOrFail($request->user);
            $ticket = new Ticket();
            $ticket->topic = $request->topic;
            $ticket->description = $request->description;
            $ticket->importance = $request->importance;
            $ticket->user()->associate($user->id);
            $ticket->society()->associate($user->society->id);
            $ticket->save();
        else:
            $ticket = new Ticket();
            $ticket->topic = $request->topic;
            $ticket->description = $request->description;
            $ticket->importance = $request->importance;
            $ticket->user()->associate(Auth::user()->id);
            $ticket->society()->associate(Auth::user()->society->id);
            $ticket->save();
        endif;
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
        $allLeaders = User::whereHas('roles', function ($q) use ($ticket) {
            $q->where('name', ['ROLE_LEADER']);
        })->get();
        foreach ($allLeaders as $leader) {
            if ($leader->society_id == $ticket->society_id) {
                $leader->notify(new NewTickets($ticket));
            }
        }
        $user->notify(new NewTickets($ticket));
        Session::flash('success', 'Le ticket à été créer, merci.');
        return redirect(route('ticket.index', ['sort=1']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show(Ticket $ticket)
    {
        $technicians = Technician::all();
        $source = Source::get();
        $sources = $source->pluck('name', 'id');
        $files = Attachment::where('ticket_id', $ticket->id)->get();
        $messages = Message::where('ticket_id', $ticket->id)->latest()->simplePaginate(5);
        $actions = Action::where('ticket_id', $ticket->id)->latest()->paginate(5);
        return view('admin.tickets.show', compact(['ticket', 'messages', 'actions', 'technicians', 'sources', 'files']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
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
    public
    function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);

        if ($ticket->state === 0):
            if ($request->state == 1):
                $ticket->close_at = Carbon::now();
                $user = User::find($ticket->user->id);
                $allLeaders = User::whereHas('roles', function ($q) use ($ticket) {
                    $q->where('name', ['ROLE_LEADER']);
                })->get();
                foreach ($allLeaders as $leader) {
                    if ($leader->society_id == $ticket->society_id && $leader->id != $user->id){
                        $leader->notify(new CloseTicket($ticket));
                    }
                }
                $softease = User::find(1);
                $softease->notify(new CloseTicket($ticket));
                $user->notify(new CloseTicket($ticket));
            endif;
        endif;
        $ticket->technician_id = $request->technician;
        $ticket->state = $request->state;
        $ticket->importance = $request->importance;
        $ticket->source()->associate($request->source);
        $ticket->save();
        Session::flash('success', 'Le ticket à été mis à jour.');
        return redirect(route('ticket.index', ['sort=1']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        Ticket::destroy($id);
        Session::flash('success', 'Le ticket à été supprimé.');
        return redirect(route('ticket.index'));
    }

}
