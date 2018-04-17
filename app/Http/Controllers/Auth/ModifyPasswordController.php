<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ModifyPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
        return view('auth.passwords.modifyPassword');
    }

    public function store(User $user, Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
            'confirm_password' => 'required',
        ]);
        $user = Auth::user();
        if ($request->password === $request->confirm_password):
            $user->password = bcrypt($request->password);
            $user->save();
        endif;

        Session::flash('success', 'Le mot de passe à été mis à jour !');
        return redirect(url('/admin'));
    }
}
