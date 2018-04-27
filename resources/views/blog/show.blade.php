@extends('base')
@section('content')
    <div class="header">
        <h1>{{$post->title}}</h1>
    </div>
    <div class="container">
        {{--LISTES DES ARTICLES--}}
        <div class="row mt-5">
            <div class="col-sm-8">
                <div class="article">
                    <div class="article-img">
                        <img src="{{$post->path}}" alt="{{$post->imgName}}" width="100%">
                    </div>
                    <div class="article-date">
                        <strong class="day">{{Carbon\Carbon::parse($post->created_at)->format('d')}}</strong>
                        <p>{{Carbon\Carbon::parse($post->created_at)->format('M Y')}}</p>
                    </div>
                    <div class="article-title">
                        <h3>{{$post->title}}</h3>
                    </div>
                    <div class="article-content">
                        <p>{!!$post->content!!}
                        </p>
                    </div>
                </div>
                <hr class="mb-5">
                @if(empty($comments->total()))
                    <h3 class="text-center">Aucun commentaire</h3>
                @else
                    @foreach($comments as $comment)
                        <h4><strong>{{$comment->username}}</strong></h4>
                        <small>{{Carbon\Carbon::parse($comment->created_at)->format('d M Y')}}</small>
                        <p> {{$comment->comment}}</p>
                    @endforeach
                @endif
                <div class="article-add-comment">
                    {{--<h4>Ajouter un commentaire</h4>--}}
                    <hr width="50%">
                    <form action="{{route('comment.store', $post->id)}}" method="post">
                        {{Form::token()}}
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="username">Username *</label>
                                <input type="text" id="username" name="username" class="form-control">
                            </div>
                            <div class="col-sm-4">
                                <label for="email">E-mail *</label>
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                            <div class="col-sm-4">
                                <label for="website">Site internet</label>
                                <input type="text" id="website" name="website" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="comment">Message *</label>
                                <textarea name="comment" id="comment" cols="30" rows="10"
                                          class="form-control"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn bg-primary-softease mt-2 float-right">Envoyer</button>
                    </form>
                </div>
            </div>


            {{--SIDE BAR--}}
            <div class="col-sm-4 pl-3">
                @include('blog.sidebar')
            </div>
        </div>
    </div>

@endsection