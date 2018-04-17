@extends('admin.base')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Edition de {{$society->name}}</h4>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => ['society.update', $society->id], 'class' => 'mb-4', 'method' => 'put']) !!}
                <div class="form-group">
                    {{ Form::label('name', 'Raison social : (Obligatoire)') }}
                    {!! Form::text('name', $society->name, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email de contact :') !!}
                    {!! Form::text('email', $society->email, ['class' => 'form-control']) !!}
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {!! Form::label('address', 'Adresse :') !!}
                            {!! Form::text('address', $society->address, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            {!! Form::label('city', 'Ville :') !!}
                            {!! Form::text('city', $society->city, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            {!! Form::label('cp', 'Code Postal :') !!}
                            {!! Form::text('cp', $society->cp, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('phone', 'Téléphone :') !!}
                            {!! Form::text('phone', $society->phone, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('fax', 'Fax :') !!}
                            {!! Form::text('fax', $society->fax, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right">Enregistrer les modifications</button>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection