@extends('admin.base')
{{--{{setlocale(LC_ALL, 'fr_FR')}}--}}
@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="form-inline">
            {{Form::open(['method' => 'GET'])}}
            <div class="form-inline">
                {{Form::text('search', null, ['class' => 'form-control'])}}
                <button type="submit" class="btn btn-secondary mx-2">Rechercher</button>
            </div>
            {{Form::close()}}
            {{Form::open(['method' => 'GET'])}}
            <select name="sort" id="sort" class="form-control">
                <option value="0">All</option>
                <option value="1">En cours</option>
                <option value="2">Clos</option>
            </select>
            <button type="submit" class="btn btn-secondary ml-2">Actualiser</button>
            {{Form::close()}}
            </div>
        </div>
        <div class="col-sm-6">
            <a href="{{route('ticket.create')}}" class="btn btn-primary mb-4 float-right">Nouveau</a>

        </div>
    </div>
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th>Objet</th>
            <th>Date de création</th>
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
                    {!! $ticket->state == 1 ? '<span class="badge badge-success">Cloturé</span>' : '<span class="badge badge-info">En cours</span>' !!}
                    {!! $ticket->importance == 1 ? '<span class="badge badge-danger">Urgent</span>' : '<span class="badge badge-secondary">Normal</span>' !!}
                </td>
                <td>{{!empty($ticket->technician->user->fullname) ? $ticket->technician->user->fullname : ' '}}</td>
                <td>
                    <a href="{{route('ticket.show', [ $ticket->id ] )}}">
                        <i class="text-center fa fa-eye" style="color:grey; font-size: 25px;"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$tickets->links('widgets.paginate')}}
@endsection