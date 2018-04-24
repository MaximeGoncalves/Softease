<?php

namespace App\Http\Controllers;

use App\Society;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class SocietyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *@return response
     */
    public function index(Request $request)
    {

        if($request->get('search')){
            $search = $request->get('search');
            $societies = Society::where('name', 'LIKE',  '%'.$search.'%')->orderBy('name')->get();
            return view('admin.society.index', ['societies' => $societies]);
        }

        $societies = Society::get();
        $users = User::get();
        $nbSocieties = Society::count();
        $nbUsers = User::count();
        return view('admin.society.index', compact('societies', 'users', 'nbSocieties', 'nbUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.society.create', compact('societies', 'users', 'nbSocieties', 'nbUsers'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:societies,name',
        ]);
        if($validatedData){
            Session::flash('error', 'La raison social existe déjà.');
        }

        $society = new Society();
        $society->name = $request->name;
        $society->address = $request->address;
        $society->city = $request->city;
        $society->cp = $request->cp;
        $society->email = $request->email;
        $society->phone = $request->phone;
        $society->fax = $request->fax;
        $society->save();
        Session::flash('success', 'La société à été créée.');
        return redirect(route('society.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $society = Society::findOrFail($id);
        return view('admin.society.edit', compact('society'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $society = Society::findOrFail($id);
        $society->name = $request->name;
        $society->email = $request->email;
        $society->address = $request->address;
        $society->city = $request->city;
        $society->cp = $request->cp;
        $society->phone = $request->phone;
        $society->fax = $request->fax;
        $society->save();
        Session::flash('success', 'Les informations ont été mis à jour.');
        return redirect(route('society.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Society::destroy($id);
        Session::flash('success', 'La suppression à été effectué.');
        return redirect(route('society.index'));
    }
}
