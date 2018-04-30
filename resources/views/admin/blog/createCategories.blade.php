@extends('admin.base')
@section('content')
    <div class="container">
        <div class="card mt-2">
            <div class="card-header">
                Ajouter une categorie
            </div>
            <div class="card-body">
                <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name" title>Nom :</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Valider</button>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection