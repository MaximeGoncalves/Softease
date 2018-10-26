@extends('admin.base')
@section('content')


    <div class="container p-0">

        <div class="card mt-2">
            <div class="card-header">
                Nouveau Ticket
            </div>
            <div class="card-body">
                {{--{{Form::open(['route' => 'ticket.store'], ['enctype' => 'multipart/form-data'])}}--}}
                <form action="{{route('ticket.store')}}" enctype="multipart/form-data" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        {{ Form::label('topic', 'Sujet de la demande : ') }}
                        {!! Form::text('topic', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Description :') !!}
                        {{--{!! Form::textarea('description', null, ['class' => 'form-control']) !!}--}}
                        <textarea name="description" id="trumbowyg" cols="30" rows="10" class=''></textarea>
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
                        @if(\Illuminate\Support\Facades\Auth::user()->society->name == 'Softease')
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="user">Utilisateur :</label>
                                    <select name="user" id="user" class="form-control">
                                        <option value="0" selected>Selectionner un utilisateur</option>
                                        @foreach($societies as $society)
                                            @if(\App\User::where('society_id', $society->id)->count() == 0)
                                            @else
                                                <optgroup label="{{ $society->name }}">
                                                    @foreach($users as $user)
                                                        @if($user->society_id == $society->id)
                                                            <option value="{{$user->id}}">{{$user->fullname}}</option>
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="technician">Technicien :</label>
                                    <select name="technician" id="technician" class="form-control">
                                        <option value="0" selected="selected">Selectionner un technicien</option>
                                        @foreach($technicians as $technician)
                                            <option value="{{$technician->id}}"> {{$technician->user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="source">Source :</label>
                                <select name="source" id="source" class="form-control">
                                    @foreach($sources as $source)
                                        <option value="{{$source->id}}">{{$source->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary float-right mt-4">Envoyer</button>
                </form>
                {{--                {{Form::close()}}--}}

            </div>
        </div>
    </div>
@endsection
