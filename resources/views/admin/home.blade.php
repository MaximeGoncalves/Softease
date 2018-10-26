@extends('admin.base')

@section('content')
    <div class="container-fluid">
        {{--<div class="card-header">Dashboard - <strong>{{Auth::user()->fullname}}</strong></div>--}}
        <div class="widget" style="color: #fff;">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card bg-warning">
                        <a href="{{route('password.index')}}" style="color: #fff">
                            <div class="card-body text-center">
                                <i class="fa fa-user" style="font-size: 20px"></i><br>
                                Mon Compte
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3">
                    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('ROLE_ADMIN'))
                        <div class="card bg-success">
                            <a href="{{route('login.create')}}" style="color: #fff">
                                <div class="card-body text-center">
                                    <i class="fa fa-lock" style="font-size: 20px"></i><br>
                                    Nouveau Login
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="card bg-success">
                            <a href="{{route('loginuser.create')}}" style="color: #fff">
                                <div class="card-body text-center">
                                    <i class="fa fa-lock" style="font-size: 20px"></i><br>
                                    Nouveau Login
                                </div>
                            </a>
                        </div>
                    @endif
                </div>
                <div class="col-lg-3">
                    <div class="card bg-danger">
                        <a href="{{route('ticket.create')}}" style="color: #fff">
                            <div class="card-body text-center">
                                <i class="fa fa-file-text" style="font-size: 20px"></i><br>
                                Nouveau ticket
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{--@if (session('status'))--}}
        {{--<div class="alert alert-success">--}}
        {{--{{ session('status') }}--}}
        {{--</div>--}}
        {{--@endif--}}

        @if(\Illuminate\Support\Facades\Auth::user()->society->name == 'Softease')
            <div class="row my-2">
                <div class="col-3">
                    <div class="card ">
                        <div class="box" >
                            <div class="title">
                                Tickets ouvert
                            </div>
                            <div class="content d-flex justify-content-center py-5">
                                <h1 style="font-size: 70px;">{{ $tickets->count() }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card ">
                        <div class="box" >
                            <div class="title">
                                Nombre Total de tickets
                            </div>
                            <div class="content d-flex justify-content-center py-5">
                                <h1 style="font-size: 70px;">{{ $allTickets }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="col-lg-3">--}}
                    {{--<div class="box" >--}}
                        {{--<div class="title">--}}
                            {{--Tickets par client--}}
                        {{--</div>--}}
                        {{--<div class="div">--}}
                            {{--<canvas id="customers"></canvas>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-lg-3">--}}
                    {{--<div class="box">--}}
                        {{--<div class="title">--}}
                            {{--Tickets par techniciens--}}
                        {{--</div>--}}
                        {{--<canvas id="technicians"></canvas>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="col-lg-6">
                    <div class="box">
                        <div class="title">
                            Tickets par mois
                        </div>
                        <canvas id="line"></canvas>
                    </div>
                </div>
            </div>

            <div class="row my-2">
                <div class="col-lg-12">
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
    </div>
    @endif

@endsection

