@extends('admin.base')
@section('content')
    {{--{{setlocale(LC_ALL, 'french')}}--}}
    <div class="container">
        @if (Auth::user()->hasRole('ROLE_ADMIN')||Auth::user()->hasRole('ROLE_TECHNICIAN'))
            {!! Form::open(['route' => ['ticket.update', $ticket->id], 'class' => 'mb-4', 'method' => 'put']) !!}
            <div class="row mb-2">
                <div class="col-sm-4">
                    <div class="input-group">
                        {{--<label for="technician" class="mt-2">Technicien </label>--}}
                        <select name="technician" class="form-control">
                            <option value="0" selected="selected">Selectionnez un technicien</option>
                            @foreach($technicians as $technician)
                                <option value="{{$technician->id}}" {{ $ticket->technician_id == $technician->id ? 'selected="selected"' : ' '}}> {{$technician->user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="input-group">
                        {{--<label for="state" class="mt-2">Etat </label>--}}
                        <select name="importance" class="form-control">
                            @if ($ticket->importance === 0 )
                                <option value="0" selected>Normal</option>
                                <option value="1">Urgent</option>
                            @else
                                <option value="0" >Normal</option>
                                <option value="1" selected>Urgent</option>
                            @endif
                        </select>
                    </div>
                </div>

                <div class="col-sm-2">
                    {{Form::select('source', $sources , $ticket->source->id, ['class' => 'form-control'])}}
                </div>

                <div class="col-sm-2">
                    <div class="input-group">
                        {{--<label for="state" class="mt-2">Etat </label>--}}

                        <select name="state" class="form-control">
                            @if ($ticket->state === 0 )
                                <option value="0" selected>En cours</option>
                                <option value="1">Clos</option>
                            @else
                                <option value="0">En cours</option>
                                <option value="1" selected>Clos</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn-secondary btn btn-block float-right">Valider</button>
                </div>
            </div>
            {{Form::close()}}
        @endif
        <div class="card">
            <div class="card-header">Ticket n°{{$ticket->id}} - Créé <em>{{$ticket->created_at->diffForHumans()}}</em>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-sm-8">
                                <h2>{{$ticket->topic}}</h2>
                                {{$ticket->user->society->name}} - <em>{{$ticket->user->fullname}}</em>
                            </div>
                            <div class="col-sm-4">
                                <div class="list-group">
                                    @foreach($files as $file)
                                        <a class="list-group-item list-group-item-action" href="{{$file->link}}"
                                           download="{{$file->name}}">{{$file->name}}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <hr>
                        <p>{!! nl2br($ticket->description) !!}</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($messages->nextPageUrl())
                    <div class="text-center mb-2"><a href="{{ $messages->nextPageUrl() }}">Messages précédents</a>
                    </div>
                @endif
                @foreach(array_reverse($messages->items()) as $message)
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <p class='text-dark {{Auth::user()->id == $message->from->id ? 'offset text-right' : '' }}'>
                                <strong>{{$message->from->fullname}} </strong>
                                <br>

                                <small>{{ $message->created_at->diffForHumans() }}</small>
                                <br>
                                {!! nl2br($message->content) !!}
                            </p>
                            <hr>
                        </div>
                    </div>
                @endforeach
                <div class="row justify-content-center mt-4">
                    <div class="col-md-10">
                        @if($messages->previousPageUrl())
                            <div class="text-center mb-2"><a href="{{ $messages->previousPageUrl() }}">Messages
                                    suivants</a>
                            </div>
                        @endif
                        <form action="{{route('message.store', $ticket->id)}}" method="post">
                            {{Form::token()}}
                            <div class="form-group">
                                <textarea name="content" placeholder="Ecriver votre message"
                                          class="form-control"></textarea>
                            </div>
                            <button class="btn btn-primary float-right" type="submit">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()