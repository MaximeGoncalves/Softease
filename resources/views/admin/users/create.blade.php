@extends('admin.base')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Nouvel Utilisateur</h4>
            </div>
            <div class="card-body">
                {{Form::open(['route' => 'user.store', 'class' => ''])}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name"> Username <em>
                                    <small>(prenom.nom)</small>
                                </em></label>
                            {{--{!! Form::label('name', 'Username (prénom.nom) :') !!}--}}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('fullname', 'Nom complet :') }}
                            {!! Form::text('fullname', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('email', 'Email :') !!}
                            {!! Form::text('email', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            {!! Form::label('society', 'Société :') !!}
                            {{Form::select('society', $society ,'Selectionez une société', ['class' => 'form-control'])}}
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            {!! Form::label('role', 'Groupe :') !!}
                            {!! Form::select('role', $roles, '' ,['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {!! Form::label('password', 'Mot de passe :') !!}
                            {!! Form::text('password', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-3 ">
                    </div>
                </div>
                <div class="col-3">
                    <label class="switch switch-3d switch-success">
                        {!! Form::hidden('active', 0) !!}
                        {!! Form::checkbox('active', 1, '', ['class' => 'switch-input']) !!}
                        <span class="switch-label"></span>
                        <span class="switch-handle"></span>
                    </label>
                    Activer ?
                </div>
                <div class="col-3">
                    <label class="switch switch-3d switch-success">
                        {!! Form::hidden('technician', 0) !!}
                        {!! Form::checkbox('technician', 1, '', ['class' => 'switch-input']) !!}
                        <span class="switch-label"></span>
                        <span class="switch-handle"></span>
                    </label>
                    Technicien ?
                </div>
                <button type="submit" class="btn btn-primary float-right">Enregistrer</button>
                {{Form::close()}}

            </div>
        </div>
    </div>

@endsection