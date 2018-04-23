<?php

namespace App\Http\Controllers;

use App\Society;
use App\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class loginsController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->get('search')) {
            $search = $request->get('search');
            $logins = Login::whereHas('society', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->orWhere('name', 'LIKE', '%' . $search . '%')
                ->orWhere('username', 'LIKE', '%' . $search . '%')->orderBy('name', 'asc')->get();
//            $logins = Login::with(['society'])->where('name', 'LIKE',  '%'.$search.'%')->orderBy('name')->get();
//            dd($logins);
            return view('admin.logins.index', ['logins' => $logins]);
        }
        $logins = Login::with('society')->get();
        return view('admin.logins.index', ['logins' => $logins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $society = Society::pluck('name', 'id');
        return view('admin.logins.create', compact('society'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'society_id' => 'required',
            'name' => 'required',
            'url' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $login = new Login;

        $login->name = $request->name;
        $login->url = $request->url;
        $login->username = $request->username;
        $login->password = encrypt($request->password);
        $login->society()->associate($request->society_id);
        $login->save();

        Session::flash('success', 'Le login à été créer.');

        return redirect(route('login.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $login = Login::findOrFail($id);
        return view('admin.logins.edit', compact('login'));
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
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
        $login = Login::findOrFail($id);

        $login->name = $request->name;
        $login->url = $request->url;
        $login->username = $request->username;
        $login->password = encrypt($request->password);

        $login->save();

        Session::flash('success', 'Le login à été modifié.');
        return redirect(route('login.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Login::destroy($id);
        Session::flash('success', 'Le login à été supprimé');
        return redirect(route('login.index'));
    }
}
