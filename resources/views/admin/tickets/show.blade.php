@extends('admin.base')
@section('content')
    {{--{{setlocale(LC_ALL, 'french')}}--}}
    <div class="container-fluid">
        <div class="col">
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
                                    <option value="0">Normal</option>
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
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">Ticket n°{{$ticket->id}} - Créé
                    <em>{{$ticket->created_at->diffForHumans()}}</em>
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
                                <div class='text-dark {{Auth::user()->id == $message->from->id ? 'offset text-right' : '' }}'>
                                    <strong>{{$message->from->fullname}} </strong>
                                    <br>
                                    <small>{{ $message->created_at->diffForHumans() }}</small>
                                    @if (Auth::user()->id == $message->from->id)
                                        <a href="{{route('message.destroy', [$message->id, $ticket->id])}}"> <i
                                                    class="fa fa-trash ml-2" style="font-size: 15px"></i>
                                        </a>
                                    @endif
                                    <br>
                                    <br>
                                    {!! nl2br($message->content) !!}
                                </div>
                                <hr>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row justify-content-center mb-5">
                <div class="col-md-12">
                    @if($messages->previousPageUrl())
                        <div class="text-center mb-2"><a href="{{ $messages->previousPageUrl() }}">Messages
                                suivants</a>
                        </div>
                    @endif
                    <form action="{{route('message.store', $ticket->id)}}" method="post" class="bg-light">
                        {{Form::token()}}
                        <div class="form-group">
                                <textarea name="content" placeholder="Ecriver votre message"
                                          class="form-control" id="trumbowyg"></textarea>
                        </div>
                        <button class="btn btn-primary float-right" type="submit">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Actions effectuées
                </div>
                <div class="card-body">
                    @if($actions->nextPageUrl())
                        <div class="text-center mb-2"><a href="{{ $actions->nextPageUrl() }}">Messages précédents</a>
                        </div>
                    @endif
                    @if(empty($actions->total()))
                        <h2 class="text-center">Aucune action</h2>
                    @else
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                @foreach(array_reverse($actions->items()) as $action)
                                    <input type="checkbox" checked disabled> <p
                                            class="d-inline">{!! nl2br($action->content) !!}</p>
                                    <br> <br>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-10">
                            @if($actions->previousPageUrl())
                                <div class="text-center mb-2"><a href="{{ $actions->previousPageUrl() }}">Messages
                                        suivants</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->hasRole('ROLE_ADMIN')||Auth::user()->hasRole('ROLE_TECHNICIAN'))
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('action.store', $ticket->id)}}" method="post">
                            {{Form::token()}}
                            <div class="form-group">
                                <input name="content" placeholder="Action menée"
                                       class="form-control"/>
                            </div>
                            <button class="btn btn-primary btn-block" type="submit">Envoyer</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
@endsection()