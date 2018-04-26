@extends('admin.base')

@section('content')
    <div class="container">
        <div class="card mt-2">
            <div class="card-header">
                Ajouter un article
            </div>
            <div class="card-body">
                <form action="{{route('blog.store')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title" title>Titre :</label>
                        <input type="text" id="title" name="title" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="img">Image :</label>
                                <input type="file" id="img" name="img" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="category">Categorie :</label>
                                <select id="category" name="category" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content">Contenu :</label>
                        <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="switch switch-3d switch-success">
                            <input type="hidden" name="online" value="0">
                            <input type="checkbox" name="online" value="1" class="switch-input">
                            {{--{!! Form::checkbox('technician', 1, '', ['class' => 'switch-input']) !!}--}}
                            <span class="switch-label"></span>
                            <span class="switch-handle"></span>
                        </label> En ligne ?
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Valider</button>
                </form>
            </div>
        </div>
@endsection