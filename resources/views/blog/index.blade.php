@extends('base')
@section('content')
    <div class="header">
        <h1>Blog</h1>
    </div>
    <div class="container">
        {{--LISTES DES ARTICLES--}}
        <div class="row mt-5">
            <div class="col-8">
                @foreach($posts as $post)
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
                        <div class="article-category">
                            <strong><i class="fas fa-hashtag"></i>{{$post->category->name}}</strong>
                        </div>
                        <div class="article-content">
                            <p>{{$post->content}}
                            </p>
                        </div>
                        <div class="article-button">
                            <a href="{{route('blog.article', $post->id)}}" class="btn btn-softease">More ...</a>
                        </div>
                    </div>
                    <hr class="mb-5">
                @endforeach
                <div class="d-flex justify-content-center">
                    {{$posts->links('widgets.paginate-blog')}}
                </div>
            </div>


            {{--SIDE BAR--}}
            <div class="col-4 pl-3">
                @include('blog.sidebar')
            </div>
        </div>
    </div>
@endsection