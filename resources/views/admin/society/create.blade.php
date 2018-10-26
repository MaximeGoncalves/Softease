@extends('admin.base')
@section('content')
    <style>
        label {
            margin: 0;
        }

        .field {
            position: relative;
            height: 72px;
            padding: 16px 0 8px 0;
        }

        .field-label {
            position: relative;
            color: #ccc9c9;
            line-height: 16px;
            font-size: 16px;
            font-weight: 400;
            display: block;
            transform: translateY(24px);
            transition: transform 0.4s;
            transform-origin: 0 50%;
        }

        .field-input {
            position: relative;
            padding: 8px 0;
            line-height: 16px;
            font-size: 16px;
            color: #777979;
            margin: 0;
            height: 32px;
            border: none;
            -webkit-appearance: none;
            display: block;
            width: 100%;
            background: transparent;
        }

        .field::after, .field::before {
            content: '';
            height: 2px;
            width: 100%;
            background-color: #ddd9d9;
            position: absolute;
            bottom: 6px;
            left: 0;
        }

        .field::after {
            background-color: #F9653C;
            transform: scaleX(0);
            transition: transform 0.4s;
        }

        .field.is-focus::after {
            transform: scaleX(1);
        }

        .has-label .field-label {
            transform: translateY(0px) scale(0.9);
        }

        .is-focus .field-label {
            transform: translateY(0px) scale(0.9);
            font-size: 12px;
            color: #F9653C;
        }

        .btn-primary {
            background-color: #F9653C;
            border: #F9653C solid;
            position: relative;

            display: block;
            margin: 30px auto;
            padding: 0;

            overflow: hidden;

            border-width: 0;
            outline: none;
            border-radius: 2px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .6);

            background-color: #F9653C;
            color: #ecf0f1;
            padding: 10px 15px;
            transition: background-color .3s;
        }
        .btn-primary:hover{
            background-color: #d35400;
        }

    </style>
    <div class="container">
        <div class="card mt-2">
            <div class="card-header">
                Nouvelle société
            </div>

            <div class="card-body">
                <form action="{{route('society.store')}}" method="post">
                    @csrf
                    <div class="field">
                        <label for="name" class="field-label">Raison social</label>
                        <input type="text" name="name" class="field-input">
                    </div>
                    <div class="field">
                        <label for="" class="field-label">E-Mail de contact :</label>
                        <input type="email" name="email" class="field-input">
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="field">
                                <label for="" class="field-label">Adresse</label>
                                <input type="text" name="address" class="field-input">
                            </div>

                        </div>
                        <div class="col-lg-3">
                            <div class="field">
                                <label for="" class="field-label">Ville</label>
                                <input type="text" name="city" class="field-input">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="field">
                                <label for="" class="field-label">Code postal</label>
                                <input type="text" name="cp" class="field-input">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="field">
                                <label for="" class="field-label">Téléphone</label>
                                <input type="text" name="phone" class="field-input">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="field">
                                <label for="" class="field-label">Fax</label>
                                <input type="text" name="fax" class="field-input">
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary float-right mt-5" value="Ajouter une société">
                </form>
            </div>
            {{--{{Form::open(['route' => 'society.store', 'class' => ''])}}--}}
            {{--<div class="form-group">--}}
            {{--{!! Form::label('email', 'Email de contact :') !!}--}}
            {{--{!! Form::text('email', null, ['class' => 'form-control']) !!}--}}
            {{--</div>--}}
            {{--<div class="row">--}}
            {{--<div class="col-6">--}}
            {{--<div class="form-group">--}}
            {{--{!! Form::label('address', 'Adresse :') !!}--}}
            {{--{!! Form::text('address', null, ['class' => 'form-control']) !!}--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-3">--}}
            {{--<div class="form-group">--}}
            {{--{!! Form::label('city', 'Ville :') !!}--}}
            {{--{!! Form::text('city', null, ['class' => 'form-control']) !!}--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-3">--}}
            {{--<div class="form-group">--}}
            {{--{!! Form::label('cp', 'Code Postal :') !!}--}}
            {{--{!! Form::text('cp', null, ['class' => 'form-control']) !!}--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}
            {{--<div class="col-sm-6">--}}
            {{--<div class="form-group">--}}
            {{--{!! Form::label('phone', 'Téléphone :') !!}--}}
            {{--{!! Form::text('phone', null, ['class' => 'form-control']) !!}--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-sm-6">--}}
            {{--<div class="form-group">--}}
            {{--{!! Form::label('fax', 'Fax :') !!}--}}
            {{--{!! Form::text('fax', null, ['class' => 'form-control']) !!}--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<button type="submit" class="btn btn-primary float-right">Ajouter une société</button>--}}
            {{--{{Form::close()}}--}}

        </div>
    </div>
    </div>

    <script>

    </script>
@endsection