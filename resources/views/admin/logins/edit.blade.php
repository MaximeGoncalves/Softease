@extends('admin.base')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Edition de {{$login->name}}</h4>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => ['login.update', $login->id], 'class' => 'mb-4', 'method' => 'put']) !!}
                {{--Société--}}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {{Form::label('society_id', 'Société :', ['class' => ''])}}
                            {{Form::text('society_id', $login->society->name,[
                            'class' => 'form-control',
                            'disabled'  => 'true'
                            ])}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        {{--Service--}}
                        <div class="form-group">
                            {{Form::label('name', 'Service :', ['class' => ''])}}
                            {{Form::text('name', $login->name,['class' => 'form-control'])}}
                        </div>
                    </div>
                    <div class="col-6">
                        {{--Url--}}
                        <div class="form-group">
                            {{Form::label('url', 'Lien :', ['class' => ''])}}
                            {{Form::text('url', $login->url,['class' => 'form-control'])}}
                        </div>
                    </div>

                    <div class="col-6">
                        {{--Service--}}
                        <div class="form-group">
                            {{Form::label('username', 'Login :', ['class' => ''])}}
                            {{Form::text('username', $login->username,['class' => 'form-control'])}}
                        </div>
                    </div>

                    <div class="col-6">
                        {{--Url--}}
                        <div class="form-group">
                            {{Form::label('password', 'Password :', ['class' => ''])}}
                            {{Form::text('password', decrypt($login->password),['class' => 'form-control'])}}
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-2 float-right">
                    Enregistrer les modifications
                </button>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection