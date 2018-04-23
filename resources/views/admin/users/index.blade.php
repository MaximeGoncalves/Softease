@extends('admin.base')

@section('content')

    <div class="container-fluid">
            <a href="{{route('user.create')}}" class="btn btn-primary mb-4 float-right">Nouveau</a>

        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Username</th>
                <th>Nom complet</th>
                <th>Email</th>
                <th>Groupe</th>
                <th>Activé ?</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->fullname}}</td>
                    <td>{{$user->email}}</td>
                    @foreach($user->roles as $role)
                        <td> {{$role->name}}</td>
                    @endforeach
                    <td>
                        <label class="switch switch-3d switch-success">
                            {!! Form::checkbox('Active', 1, $user->active, ['class' => 'switch-input','disabled']) !!}
                            <span class="switch-label"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('user.edit', [ $user->id ] )}}"><i
                                        class="fa fa-pencil"
                                        style="color:grey; font-size: 20px;"></i></a>

                            {!! Form::open(['route' => ['user.destroy', $user->id], 'class' => 'mb-4', 'method' => 'delete']) !!}

                            <button type="submit"
                                    style="border: none; background: transparent; cursor: pointer;"
                                    class="mx-1">
                                <i class="fa fa-trash" style="color:red;font-size: 20px"></i>
                            </button>
                            {!! Form::close() !!}

                            <a href="{{route('password.adminReset',[ $user->id ])}}" title="Modifier le mot de passe"><i
                                        class="fa fa-lock"
                                        style="color:grey; font-size: 20px;"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
@endsection