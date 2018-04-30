<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Softease</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/softease.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css"
          integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
</head>
<body>
<div class="header-menu">
    <div class="container h-100">
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <a href="#" class="header_logo">
                    S<span class="primary">.</span>
                </a>
            </div>
            <div class="col-xs-12 col-sm-8">
                <nav class="menu justify-content-end">
                    <a href="/" class="menu-item">Softease</a>
                    <a href="#" class="menu-item">Réalisations</a>
                    <a href="{{route('blog.blog')}}" class="menu-item">Blog</a>
                    <a href="{{route('contact')}}" class="menu-item">Contact</a>
                    @if(\Illuminate\Support\Facades\Auth::user())
                        <a href="{{route('home')}}" class="menu-item">{{Auth::user()->name}}</a>
                    @else
                        <a href="{{route('home')}}" class="menu-item">Connexion</a>
                    @endif
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    @if (Session('success'))
        <div class="alert alert-success">
            {{Session('success')}}
        </div>
    @endif
    @if (Session('error'))
        <div class="alert alert-danger">
            {{Session('error')}}
        </div>
    @endif
</div>
@yield('content')

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-12">
                <h3>Social</h3>
                <p>
                    <a href="#"><i class="fab fa-twitter-square"></i></a>
                    <a href="#"><i class="fab fa-github-square"></i></a>
                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                </p>
            </div>
            <div class="col-sm-4 col-12">
                <h3>Other</h3>
                <p><a href="#">Lorem Ipsum</a><br>
                    <a href="#">Lorem Ipsum</a><br>
                    <a href="#">Lorem Ipsum</a><br>
                    <a href="#">Lorem Ipsum</a><br>
                    <a href="#">Lorem Ipsum</a></p>
            </div>
            <div class="col-sm-4 col-12">
                <h3>Règlementaire</h3>
                <p><a href="#">Mentions légales</a></p>
            </div>
        </div>
    </div>
</footer>
@yield('scripts')
</body>

</html>