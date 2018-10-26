<?php

namespace App\Http\Controllers;

use App\Mail\contact;
use App\Society;
use App\Technician;
use App\Ticket;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.css.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::where('state', 0)->get();
        $allTickets = Ticket::count();
        return view('admin.home', compact(['tickets', 'allTickets']));
    }

    public function charts()
    {
        $data = Ticket::all()->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('m');
        });
        return response()->json($data);
    }

    public function technicians()
    {
        $datas = Ticket::where('state', 1)->get();
        $users = Technician::all();
        $data = [];
        foreach ($users as $user) {
            $data[$user->user->name] = Ticket::where('technician_id', $user->id)->count();
        }
        return response()->json($data);

    }

    public function customers()
    {
        $datas = Ticket::where('state', 1)->get();
        $clients = Society::all();
        $data = [];
        foreach ($clients as $client) {
            $data[$client->name] = Ticket::where('society_id', $client->id)->count();
        }
        return response()->json($data);
    }

    public function contact()
    {
        return view('contact.index');
    }

    public function SendMail(Request $request)
    {
        $request->validate([
            'g-recaptcha-response' => 'required|recaptcha'
        ]);
        $fullname = $request->fullname;
        $phone = $request->fullname;
        $email = $request->email;
        $content = $request->message;

        $user = User::where('name', 'admin')->first();

        Mail::send('vendor.notifications.contact', compact(['fullname', 'phone', 'email', 'content']), function ($m) use ($user) {
            $m->from('no-reply@softease.fr', 'Softease.fr');
            $m->to($user->email, $user->name)->subject('Nouveau message depuis le fomulaire de contact !');
        });

        Session::flash('success', 'L\'email a été envoyé !');
        return redirect(route('contact'));
    }
}
