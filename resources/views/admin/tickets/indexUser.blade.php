@extends('admin.base')
{{setlocale(LC_ALL, 'fr_FR')}}
@section('content')
    <div class="row">
        <div class="col-sm-6">
            {{Form::open(['method' => 'GET'])}}
            <div class="form-inline">
                {{Form::text('search', null, ['class' => 'form-control'])}}
                <button type="submit" class="btn btn-secondary ml-2">Rechercher</button>
            </div>
            {{Form::close()}}
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
            <th>Techncien</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td> {{$ticket->topic}}</td>
                <td> {{ $ticket->created_at->diffForHumans() }}</td>
                <td>{{$ticket->technician_id}}</td>
                <td>
                    <a href="{{route('ticket.show', [ $ticket->id ] )}}">
                        <i class="text-center fa fa-eye" style="color:grey; font-size: 25px;"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection