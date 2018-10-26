@extends('admin.base')

@section('content')

    <div class="row">
        <div class="col-sm-6">
            {{Form::open(['method' => 'GET'])}}
            <div class="form-inline">
            {{Form::text('search', null, ['class' => 'form-control'])}}
            <button type="submit" class="btn btn-secondary ml-2">Rechercher</button>
            </div>
            {{Form::close()}}
        </div>
        <div class="col-sm-6">
        <a href="{{route('loginuser.create')}}" class="btn btn-primary mb-4 float-right">Nouveau</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Site</th>
                <th>url</th>
                <th>Identifiant</th>
                <th>Mot de passe</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @foreach($logins as $login)
                <tr>
                    <td> {{$login->name}}</td>
                    <td><a href="{{$login->url}}">{{$login->url}}</a></td>
                    <td> {{$login->username}}</td>
                    <td> {{decrypt($login->password)}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('loginuser.edit', [ $login->id ] )}}"><i class="fa fa-pencil"
                                                                                  style="color:grey; font-size: 20px;"></i></a>
                            {!! Form::open(['route' => ['loginuser.destroy', $login->id], 'method' => 'delete']) !!}

                            <button type="submit" style="border: none; background: transparent; cursor: pointer;"
                                    class="d-inline" onclick="return confirm('Etes vous sûr de vouloir supprimer la ligne ?');">
                                <i class="fa fa-trash ml-2" style="color:red;font-size: 20px"></i>
                            </button>
                            {!! Form::close() !!}
                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection