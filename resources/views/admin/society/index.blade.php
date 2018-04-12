@extends('admin.base')
@section('content')
    <div class="row">
        <div class="col-sm-6">
            {{Form::open(['method' => 'GET'])}}
            <div class="form-inline ml-3">
                {{Form::text('search', null, ['class' => 'form-control'])}}
                <button type="submit" class="btn btn-secondary m-2">Rechercher</button>
            </div>
            {{Form::close()}}
        </div>
    </div>
    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th>Société</th>
                    <th>Email</th>
                    <th>Adresse</th>
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($societies as $society)
                    <tr>
                        <td> {{$society->name}}</td>
                        <td> {{$society->email}}</td>
                        <td> {{$society->address}}</td>
                        <td> {{$society->phone}}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{route('society.edit', [ $society->id ] )}}"><i
                                            class="fa fa-pencil"
                                            style="color:grey; font-size: 20px;"></i></a>

                                {!! Form::open(['route' => ['society.destroy', $society->id], 'class' => 'mb-4', 'method' => 'delete']) !!}

                                <button type="submit"
                                        style="border: none; background: transparent; cursor: pointer;"
                                        class="d-inline">
                                    <i class="fa fa-trash ml-2" style="color:red;font-size: 20px"></i>
                                </button>

                                {!! Form::close() !!}
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
    </div>


@endsection