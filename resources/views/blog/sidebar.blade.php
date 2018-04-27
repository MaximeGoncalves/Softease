<h3>Derniers articles</h3>
<hr>
<div class="side-bar">
    @foreach($latests as $post)
        <div class="row mb-3">
            <div class="col">
                <div class="side-bar-img">
                    <img src="{{$post->path}}" alt="{{$post->imgName}}" width="100%">
                </div>
            </div>
            <div class="col">
                <div class="side-bar-title">
                    <strong><a href="{{route('blog.article', $post->id)}}"> {{$post->title}}</a></strong>
                </div>
                <div class="side-bar-date">
                    <small>
                        <i class="fas fa-clock"></i> {{Carbon\Carbon::parse($post->created_at)->format('d M Y')}}
                    </small>
                </div>
            </div>
        </div>
    @endforeach
    <div class="side-bar-category">
        <h3 class="mt-5">Categories</h3>
        <hr>
        @foreach($categories as $category)
            <a href="{{route('blog.category',$category->id)}}" class="d-block"> {{$category->name}} ({{$category->posts()->count()}})</a>
        @endforeach
    </div>
</div>

