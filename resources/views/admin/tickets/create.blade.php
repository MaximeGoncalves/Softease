@extends('admin.base')
@section('content')
    <div class="container">

        <div class="card mt-2">
            <div class="card-header">
                Nouveau Ticket
            </div>
            <div class="card-body">
                {{Form::open(['route' => 'ticket.store', multipart/form-data ])}}
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

                <div class="row">
                    <div class="col-sm-8">
                        @if(\Illuminate\Support\Facades\Auth::user()->society->name == 'Softease')
                            <div class="form-group">
                                <label for="society">Utilisateur :</label>
                                <select name="user" id="user" class="form-control">
                                    <option value="0" selected>Selectionner un utilisateur</option>
                                    @foreach($societies as $society)
                                        <optgroup label="{{$society->name}}">
                                            @foreach($users as $user)
                                                @if($user->society_id == $society->id)
                                                    <option value="{{$user->id}}">{{$user->fullname}}</option>
                                                @endif
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary float-right mt-4">Envoyer</button>
                    </div>
                </div>
                {{Form::close()}}

            </div>
        </div>
    </div>
@endsection
