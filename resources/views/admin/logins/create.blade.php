@extends('admin.base')

@section('content')
    <div class="row">
        <div class="col-sm-8">
            <h2>Ajouter un login</h2>
            <hr>
            {!! Form::open(['route' => 'login.store', 'class' => 'mb-4']) !!}
            {{--Société--}}
            <div class="form-group">
                {{Form::label('society_id', 'Société :', ['class' => ''])}}
                {{Form::select('society_id', $society ,'Selectionez une société', ['class' => 'form-control'])}}
            </div>
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
@endsection