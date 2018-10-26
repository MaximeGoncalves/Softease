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
        $this->middleware(['auth', 'UserForbidden']);

    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $search = $request->get('search');
            $logins = Login::whereHas('society', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->orWhere('name', 'LIKE', '%' . $search . '%')
                ->orWhere('username', 'LIKE', '%' . $search . '%')->orderBy('name', 'asc')->get();
            $data = '';
            foreach ($logins as $login){
                $data .= '<tr><td>'. $login->society->name .'</td>
                                <td>'. $login->name .'</td>
                                <td>'. $login->url .'</td><td>'. $login->username .'</td>
                                <td>'. decrypt($login->password) .'</td>
                                <td><div class="btn-group">
                            <a href="'.route('login.edit', [ $login->id ] ).'">
                            <i class="fa fa-pencil" style="color:grey; font-size: 20px;"></i></a>
                            <form action="'.route('login.destroy', $login->id).'" method="POST">
                            '.csrf_field().'
                            <input type="hidden" name="_method" value="delete" />
                            <button type="submit" style="border: none; background: transparent; cursor: pointer;"
                                    class="d-inline" onclick="return confirm(\'Etes vous sûr de vouloir supprimer le ticket ?\');">
                                <i class="fa fa-trash ml-2" style="color:red;font-size: 20px"></i>
                            </button>
                            </form>
                        </div></td>
                         </tr>';
            }
            return json_encode($data);
        }
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
