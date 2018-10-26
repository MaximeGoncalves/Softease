@extends('admin.base') {{--{{setlocale(LC_ALL, 'fr_FR')}}--}} @section('content')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-xl-6 col-md-5 col-sm-12">
                <div class="form-group">
                    <form action="" method="GET" class="form-row">
                        <div class="col-md-8">
                            <input type="text" name="search" class="form-control mb-1 mb-md-0">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-secondary btn-block">Rechercher</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-4 col-md-5 col-sm-12 pl-xl-0">
                {{Form::open(['method' => 'GET', 'class' => 'form-row'])}}
                <div class="col-md-5">
                    <select name="sort" id="sort" class="form-control">
                        <option value="0" {{\Illuminate\Support\Facades\Session::get('sort') == 0 ? 'selected' : ' '}}>All
                        </option>
                        <option value="1" {{\Illuminate\Support\Facades\Session::get('sort') == 1 ? 'selected' : ' '}}>En
                            cours
                        </option>
                        <option value="2" {{\Illuminate\Support\Facades\Session::get('sort') == 2 ? 'selected' : ' '}}>
                            Clos
                        </option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary button-block">Actualiser</button>
                </div>
                {{Form::close()}}
            </div>

            <div class="col-xl-2 col-md-2 col-sm-12">
                <a href="{{route('ticket.create')}}" class="btn btn-primary float-right button-block">Nouveau</a>
            </div>
        </div>

        <table class="table adaptive table-striped table-sm">
            <thead>
            <tr>
                <th>Objet</th>
                <th>Création</th>
                <th>Status</th>
                <th>Technicien</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td> {{$ticket->topic}}</td>
                    <td> {{ $ticket->created_at->diffForHumans() }}</td>
                    <td>
                        {!! $ticket->state == 1 ? '
                        <span class="badge badge-success">Cloturé</span>' : '
                        <span class="badge badge-info">En cours</span>' !!} {!! $ticket->importance == 1 ? '
                <span class="badge badge-danger">Urgent</span>' : '
                ' !!}
                    </td>
                    <td>{{!empty($ticket->technician->user->fullname) ? $ticket->technician->user->fullname : ' '}}</td>
                    <td>
                        <a href="{{route('ticket.show', [ $ticket->id ] )}}">
                            <i class="text-center fa fa-eye" style="color:grey; font-size: 25px;"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if (empty($tickets->total()))
            <h3 class="text-center mt-5">Il n'y a aucun ticket par ici.</h3>
        @endif
        {{$tickets->links('widgets.paginate')}}
    </div>
    @endsection