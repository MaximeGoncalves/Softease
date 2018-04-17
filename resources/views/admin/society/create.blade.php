@extends('admin.base')
@section('content')
    <div class="container">
        <div class="card mt-2">
            <div class="card-header">
                Nouvelle société
            </div>
            <div class="card-body">
                {{Form::open(['route' => 'society.store', 'class' => ''])}}
                <div class="form-group">
                    {{ Form::label('name', 'Raison social : (Obligatoire)') }}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email de contact :') !!}
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {!! Form::label('address', 'Adresse :') !!}
                            {!! Form::text('address', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            {!! Form::label('city', 'Ville :') !!}
                            {!! Form::text('city', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-3"><div class="form-group">
                            {!! Form::label('cp', 'Code Postal :') !!}
                            {!! Form::text('cp', null, ['class' => 'form-control']) !!}
                        </div></div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('phone', 'Téléphone :') !!}
                            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('fax', 'Fax :') !!}
                            {!! Form::text('fax', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right">Ajouter une société</button>
                {{Form::close()}}

            </div>
        </div>
    </div>
    @endsection