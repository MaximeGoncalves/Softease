<?php

namespace App\Http\Controllers;

use App\Role;
use App\Society;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $society = Society::pluck('name', 'id');
        $roles = Role::pluck('name', 'id');
        return view('admin.users.create', compact('society', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->active = $request->active;
        $user->society()->associate($request->society);
        $user->save();
        $user->roles()->attach($request->role);

        Session::flash('success', 'Utilisateur ajouter à la base de donnée');
        return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit(int $id)
    {
        $user = User::with(['roles', 'society'])->find($id);
        $society = Society::pluck('name', 'id');
        $roles = Role::pluck('name', 'id');
        return view('admin.users.edit', compact('user', 'society', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return Response
     */
    public function update(Request $request, $id)
    {


        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->society()->associate($request->society);
        $user->roles()->sync($request->role);
        $user->active = $request->active;
        $user->save();
        Session::flash('success', 'Les modifications ont été éffectuées');
        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        Session::flash('success', 'Utilisateur l\'utilisateur à été supprimé de la base de données.');
        return redirect(route('user.index'));
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        Session::flash('success', 'Vous avez été déconnecté.');
        return redirect('/login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
