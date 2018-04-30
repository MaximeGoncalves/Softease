<?php

namespace App\Http\Controllers;

use App\Mail\contact;
use App\User;
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
        return view('admin.home');
    }

    public function contact()
    {
        return view('contact.index');
    }

    public function SendMail(Request $request)
    {
        $request->validate([
            'g-recaptcha-response'=>'required|recaptcha'
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
