@extends('admin.base')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">Dashboard - <strong>{{Auth::user()->fullname}}</strong></div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
        @if(\Illuminate\Support\Facades\Auth::user()->society->name == 'Softease')
        <div class="row my-2">
            <div class="col-lg-5">
                <div class="box">
                    <div class="title">
                        Tickets par mois
                    </div>
                    <canvas id="line"></canvas>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="box">
                    <div class="title">
                        Tickets ouvert
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
                            <th>Status</th>
                            <th class="technicien">Technicien</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <td> {{$ticket->topic}}</td>
                                <td class="demandeur"> {{$ticket->user->fullname}}</td>
                                <td class="cell-hidden"> {{ $ticket->created_at->diffForHumans() }}</td>
                                @if (Auth::user()->hasRole('ROLE_ADMIN'))
                                    <td> {{$ticket->user->society->name}}</td>
                                @endif
                                <td>
                                    {!! $ticket->state == 1 ? '<span class="badges badge badge-success">Cloturé</span>' : '<span class="badge badges badge-info">En cours</span>' !!}
                                    {!! $ticket->importance == 1 ? '<span class="badge badges badge-danger">Urgent</span>' : ' ' !!}
                                </td>
                                <td class="technicien">{{!empty($ticket->technician->user->fullname) ? $ticket->technician->user->fullname : ' '}}</td>
                                <td>
                                    <div class="btn-group btn-action">
                                        <a href="{{route('ticket.show', [ $ticket->id ] )}}">
                                            <i class="text-center fa fa-eye"
                                               style="color:grey; font-size: 20px;"></i></a>
                                        @if (\Illuminate\Support\Facades\Auth::user()->hasRole('ROLE_ADMIN'))
                                            {!! Form::open(['route' => ['ticket.destroy', $ticket->id], 'method' => 'delete']) !!}
                                            <button type="submit"
                                                    style="border: none; background: transparent; cursor: pointer;"
                                                    class="d-inline">
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
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="box">
                    <div class="title">
                        Tickets par client
                    </div>
                    <canvas id="customers"></canvas>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="box">
                    <div class="title">
                        Tickets par techniciens
                    </div>
                    <canvas id="technicians"></canvas>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

