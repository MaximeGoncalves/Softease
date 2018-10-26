<?php

namespace App\Http\Controllers;

use App\CustomersLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomersLoginsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->get('search')) {
            $search = $request->get('search');
            $logins = CustomersLogins::where('name', 'like', '%'.$search.'%')
                ->orWhere('username', 'like', '%'.$search.'%')
                ->get();
            return view('admin.loginsCustomers.index', ['logins' => $logins]);
        }
        $logins = CustomersLogins::where('society_id', Auth::user()->society->id)->get();
        return view('admin.loginsCustomers.index', compact('logins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.loginsCustomers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'name' => 'required',
        'url' => 'required',
        'username' => 'required',
        'password' => 'required',
    ]);

        $login = new CustomersLogins();

        $login->name = $request->name;
        $login->url = $request->url;
        $login->username = $request->username;
        $login->password = encrypt($request->password);
        $login->society_id = Auth::user()->society->id;
        $login->save();;

        Session::flash('success', 'Le login a été créé.');

        return redirect(route('loginuser.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $login = CustomersLogins::findOrFail($id);
        return view('admin.loginsCustomers.edit', compact('login'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
        $login = CustomersLogins::findOrFail($id);

        $login->name = $request->name;
        $login->url = $request->url;
        $login->username = $request->username;
        $login->password = encrypt($request->password);

        $login->save();

        Session::flash('success', 'Le login à été modifié.');
        return redirect(route('loginuser.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CustomersLogins::destroy($id);
        Session::flash('success', 'Le login à été supprimé');
        return redirect(route('loginuser.index'));
    }
}
