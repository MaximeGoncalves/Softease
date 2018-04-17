@extends('admin.base')
@section('content')
    <div class="container">

        <div class="card mt-2">
            <div class="card-header">
                Nouveau Ticket
            </div>
            <div class="card-body">
                {{Form::open(['route' => 'ticket.store', 'enctype' => 'multipart/form-data' ])}}
                <div class="form-group">
                    {{ Form::label('topic', 'Sujet de la demande : ') }}
                    {!! Form::text('topic', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description', 'Description :') !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {!! Form::label('importance', 'Importance :') !!}
                            {!! Form::select('importance', ['0' => 'Normal', '1' => 'Urgent'], null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-6">

                        <label for="">Pièce(s) jointe(s) :</label>
                        <input type="file" name="pj[]" class="form-control" multiple>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right">Envoyer</button>
                {{Form::close()}}

            </div>
        </div>
    </div>
@endsection
