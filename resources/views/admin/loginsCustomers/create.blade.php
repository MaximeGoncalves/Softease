@extends('admin.base')

@section('content')
    <div class="container">
        <div class="card mt-2">
            <div class="card-header">
                Ajouter un login
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'loginuser.store', 'class' => 'mb-4']) !!}
                <div class="row">
                    <div class="col-6">
                        {{--Service--}}
                        <div class="form-group">
                            {{Form::label('name', 'Service :', ['class' => ''])}}
                            {{Form::text('name', '',['class' => 'form-control'])}}
                        </div>
                    </div>

                    <div class="col-6">
                        {{--Url--}}
                        <div class="form-group">
                            {{Form::label('url', 'Lien :', ['class' => ''])}}
                            {{Form::text('url', 'http://',['class' => 'form-control'])}}
                        </div>
                    </div>

                    <div class="col-6">
                        {{--Service--}}
                        <div class="form-group">
                            {{Form::label('username', 'Login :', ['class' => ''])}}
                            {{Form::text('username', '',['class' => 'form-control'])}}
                        </div>
                    </div>

                    <div class="col-6">
                        {{--Url--}}
                        <div class="form-group">
                            {{Form::label('password', 'Password :', ['class' => ''])}}
                            {{Form::text('password', '',['class' => 'form-control'])}}
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary mb-2 float-right">
                    Ajouter un login
                </button>
                {!! Form::close() !!}
            </div>
        </div>
@endsection