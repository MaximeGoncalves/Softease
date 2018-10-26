@extends('admin.base')
@section('content')
    {{--{{setlocale(LC_ALL, 'fr_FR')}}--}}
    {{--{{setlocale(LC_TIME, 'fr_FR.utf8')}}--}}
    <div class="row mb-2">
        <div class="col-xl-4 col-md-5 col-sm-12">
            <div class="form-group">
                <form action="" method="GET" class="form-row">
                        <input type="text" name="search" id="search" class="form-control mb-1 mb-md-0" placeholder="Rechercher">
                </form>
            </div>
        </div>
        <div class="col-xl-4 col-md-5 col-sm-12 pl-xl-0">
            {{Form::open(['method' => 'GET', 'class' => 'form-row'])}}
            <div class="col-md-5">
                <select name="sort" id="sort" class="form-control">
                    <option value="" {{request('sort') == null ? 'selected' : ' '}}>All
                    </option>
                    <option value="0" {{request('sort') == 1 ? 'selected' : ' '}}>En
                        cours
                    </option>
                    <option value="1" {{request('sort') == 2 ? 'selected' : ' '}}>
                        Clos
                    </option>
                </select>
            </div>

            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('ROLE_ADMIN'))
                <div class="col-md-5">
                    <select name="technician" id="technician" class="form-control">

                        <option value="">
                            All
                        </option>
                        @foreach($technicians as $technician)
                            {{--<option value="{{$technician->id}}" old("category_id")>{{$technician->user->fullname}}</option>--}}
                            <option value="{{ $technician->id }}">{{ $technician->user->fullname }}</option>
                        @endforeach

                    </select>
                </div>
            @endif
            {{Form::close()}}
        </div>
        <div class="col-xl-2 col-md-2 col-sm-12 offset-xl-2">
            <a href="{{route('ticket.create')}}" class="btn btn-primary float-right button-block">Nouveau</a>
        </div>

    </div>
    <table class="table adaptive table-striped table-sm">
        <thead>
        <tr>
            <th>Objet</th>
            <th class="demandeur">Demandeur</th>
            <th class="cell-hidden">Création</th>
            @if (Auth::user()->hasRole('ROLE_ADMIN')||Auth::user()->hasRole('ROLE_TECHNICIAN'))
                <th> Société</th>
            @endif
            <th class="technicien">Technicien</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="tbody">
        @foreach($tickets as $ticket)
            <tr>
                <td> {{$ticket->topic}}</td>
                <td class="demandeur"> {{$ticket->user->fullname}}</td>
                <td class="cell-hidden"> {{ $ticket->created_at->diffForHumans() }}</td>
                @if (Auth::user()->hasRole('ROLE_ADMIN'))
                    <td> {{$ticket->user->society->name}}</td>
                @endif
                <td class="technicien">{{!empty($ticket->technician->user->fullname) ? $ticket->technician->user->fullname : ' '}}</td>
                <td class="d-flex flex-column">
                    {!! $ticket->state == 1 ? '<span class="badges badge badge-success mb-2">Cloturé</span>' : '<span class="badge badges badge-info mb-2">En cours</span>' !!}
                    {!! $ticket->importance == 1 ? '<span class="badge badges badge-danger mb-2">Urgent</span>' : ' ' !!}
                    <span class="badges badge badge-warning mb-2">{{ $ticket->appointment ? date('d/M H:i', strtotime($ticket->appointment)) : '' }}</span>
                </td>
                <td>
                    <div class="btn-group btn-action">
                        <a href="{{route('ticket.show', [ $ticket->id ] )}}">
                            <i class="text-center fa fa-eye" style="color:grey; font-size: 20px;"></i></a>
                        @if (\Illuminate\Support\Facades\Auth::user()->hasRole('ROLE_ADMIN'))
                            {!! Form::open(['route' => ['ticket.destroy', $ticket->id], 'method' => 'delete']) !!}
                            <button type="submit"
                                    style="border: none; background: transparent; cursor: pointer;"
                                    class="d-inline"
                                    onclick="return confirm('Etes vous sûr de vouloir supprimer le ticket ?');">
                                <i class="fa fa-trash ml-2" style="color:red; font-size: 20px;"></i>
                            </button>
                            {!! Form::close() !!}
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    @if (empty($tickets->total()))
        <h3 class="text-center mt-5">Il n'y a aucun ticket par ici.</h3>
    @endif
    {{$tickets->links('widgets.paginate')}}


@endsection