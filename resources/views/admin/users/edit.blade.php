@extends('admin.base')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Edition {{$user->name}}</h4>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => ['user.update', $user->id], 'class' => 'mb-4', 'method' => 'put']) !!}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('name', 'Nom :') }}
                            {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('fullname', 'Nom complet :') }}
                            {!! Form::text('fullname', $user->fullname, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
               <div class="row">
                   <div class="col-sm-6">
                       <div class="form-group">
                           {!! Form::label('email', 'Email :') !!}
                           {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
                       </div>
                   </div>
                   <div class="col-3">
                       <div class="form-group">
                           {!! Form::label('society', 'Société :') !!}
                           {{Form::select('society', $society , $user->society->id, ['class' => 'form-control'])}}
                       </div>
                   </div>
                   <div class="col-3">
                       <div class="form-group">
                           {!! Form::label('role', 'Groupe :') !!}
                           {!! Form::select('role', $roles , $user->roles->first()->id ,['class' => 'form-control']) !!}
                       </div>
                   </div>
               </div>
                <div class="row mt-5">

                </div>
                <div class="col-3">
                    <label class="switch switch-3d switch-success">
                        {!! Form::hidden('active', 0) !!}
                        {!! Form::checkbox('active', 1, $user->active, ['class' => 'switch-input']) !!}
                        <span class="switch-label"></span>
                        <span class="switch-handle"></span>
                    </label>
                    Activer ?
                </div>
                <div class="col-3">
                    <label class="switch switch-3d switch-success">
                            <input type="checkbox" value="1" name="technician" {{empty($technician) ? ' ' : 'checked'}} class="switch-input">
                            {{--{!! Form::checkbox('technician', 1, $technician, ['class' => 'switch-input']) !!}--}}
                        {{--@else--}}
                        {{--{!! Form::hidden('technician', 0) !!}--}}
                        {{--@endif--}}
                        <span class="switch-label"></span>
                        <span class="switch-handle"></span>
                    </label>
                    Technicien ?
                </div>
                <button type="submit" class="btn btn-primary float-right">Enregistrer</button>
                {{Form::close()}}

            </div>
        </div>
    </div>

@endsection