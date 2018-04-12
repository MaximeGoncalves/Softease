@extends('admin.base')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>Utilisateurs par groupes</strong>
                        </div>
                        <div class="card-body">
                            <div class="default-tab">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                           href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Admin</a>
                                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
                                           href="#nav-profile" role="tab" aria-controls="nav-profile"
                                           aria-selected="false">Technicien</a>
                                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab"
                                           href="#nav-contact" role="tab" aria-controls="nav-contact"
                                           aria-selected="false">Leader</a>
                                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab"
                                           href="#nav-user" role="tab" aria-controls="nav-user" aria-selected="false">User</a>
                                    </div>
                                </nav>
                                <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                         aria-labelledby="nav-home-tab">
                                        @include('admin.roles.include.table', ['users' => $admins])
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                         aria-labelledby="nav-profile-tab">
                                        @include('admin.roles.include.table', ['users' => $technicians])

                                    </div>
                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                         aria-labelledby="nav-contact-tab">
                                        @include('admin.roles.include.table', ['users' => $leaders])

                                    </div>
                                    <div class="tab-pane fade" id="nav-user" role="tabpanel"
                                         aria-labelledby="nav-contact-tab">
                                        @include('admin.roles.include.table', ['users' => $users])
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Groupes</strong>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead class="thead">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->description}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{route('role.edit', [ $role->id ] )}}"><i
                                                            class="fa fa-pencil"
                                                            style="color:grey; font-size: 20px;"></i></a>

                                                {!! Form::open(['route' => ['role.destroy', $role->id], 'class' => 'mb-4', 'method' => 'delete']) !!}

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
            </div>
        </div>
@endsection