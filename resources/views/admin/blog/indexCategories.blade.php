@extends('admin.base')

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
            <a href="{{route('category.create')}}" class="btn btn-primary mb-4 float-right">Nouveau</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Nombre d'articles</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->name}}</td>
                    <td>{{$category->posts()->count()}}</td>
                    <td>
                        <div class="btn-group btn-action">
                            <a href="{{route('category.edit', $category->id)}}"><i class="text-center fa fa-pencil"
                                                                                        style="color:grey; font-size: 20px;"></i></a>
                            <form action="{{route('category.destroy', $category->id)}}" method="post">
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit"
                                        style="border: none; background: transparent; cursor: pointer;"
                                        class="d-inline">
                                    <i class="fa fa-trash ml-2" style="color:red; font-size: 20px;"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection