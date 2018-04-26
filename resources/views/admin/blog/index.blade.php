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
            <a href="{{route('blog.create')}}" class="btn btn-primary mb-4 float-right">Nouveau</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{$post->title}}</td>
                    <td>{{$post->author}}</td>
                    <td>{{$post->online}}</td>
                    <td>{{$post->created_at}}</td>
                    <td><a href="{{route('blog.edit', $post->id)}}">edit</a> /
                        <form action="{{route('blog.destroy', $post->id)}}" method="post">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit">Supprimé</button>
                        </form>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection