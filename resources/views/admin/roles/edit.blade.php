@extends('admin.base')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Edition {{$role->name}}</h4>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => ['role.update', $role->id], 'class' => 'mb-4', 'method' => 'put']) !!}
                <div class="form-group">
                    {{ Form::label('name', 'Nom :') }}
                    {!! Form::text('name', $role->name, ['class' => 'form-control']) !!}
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('description', 'Description :') !!}
                            {!! Form::textarea('description', $role->description, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                    <button type="submit" class="btn btn-primary float-right">Enregistrer</button>
                <em>Pas de modification en cascade si changement du nom.</em>
                    {{Form::close()}}
            </div>
        </div>
    </div>

@endsection