@extends('admin.base')
@section('content')
    <div class="container">
        <div class="card mt-2">
            <div class="card-header">
                Edition de la categorie : {{ $category->name }}
            </div>
            <div class="card-body">
                <form action="{{route('category.update', $category->id)}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PUT">
                    <div class="form-group">
                        <label for="name" title>Nom :</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{$category->name}}">
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Valider</button>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection