<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>@yield('title', 'Softease')</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cs-skin-elastic.css') }}">
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/solid.js"
            integrity="sha384-P4tSluxIpPk9wNy8WSD8wJDvA8YZIkC6AQ+BfAFLXcUZIPQGu4Ifv4Kqq+i2XzrM"
            crossorigin="anonymous"></script>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

<!-- Left Panel -->

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
                    aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="">Softease</a>
            <a class="navbar-brand hidden" href="">S</a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{route('home')}}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>
                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('ROLE_ADMIN'))
                <h3 class="menu-title">GESTION CLIENT</h3><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false"> <i class="menu-icon fa fa-building"></i>Sociétés</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-plus"></i><a href="{{route('society.create')}}">Ajouter</a></li>
                        <li><i class="menu-icon fa fa-list-ul"></i><a href="{{route('society.index')}}">Afficher la liste</a></li>
                    </ul>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Utilisateurs</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-user-plus"></i><a href="{{route('user.create')}}">Ajouter</a></li>
                        <li><i class="menu-icon fa fa-list-ul"></i><a href="{{route('user.index')}}">Afficher la liste</a></li>
                        <li><i class="menu-icon fa fa-users"></i><a href="{{route('role.index')}}">Gestions des groupes</a></li>
                    </ul>
                </li>
                @endif
                <h3 class="menu-title">Applications</h3><!-- /.menu-title -->
                <li>
                <li class="menu-item-has-children dropdown">
                    <a href="" class= "dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false"> <i class="menu-icon fa ti-email"></i>SFTicket</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-plus"></i><a href="{{route('ticket.create')}}">Ajouter</a></li>
                        <li><i class="menu-icon fa fa-list-ul"></i><a href="{{route('ticket.index', ['sort' => 1])}}">Afficher la liste</a></li>
                    </ul>
                </li>
                </li>
                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('ROLE_ADMIN'))
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false"> <i class="menu-icon fa fa-lock"></i>Logins</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-plus"></i><a href="{{route('login.create')}}">Ajouter</a></li>
                        <li><i class="menu-icon fa fa-list-ul"></i><a href="{{route('login.index')}}">Afficher la liste</a></li>
                    </ul>
                </li>
                @endif

                <h3 class="menu-title">PARAMETRES</h3><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Mon compte</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-sign-in"></i><a href="{{route('password.index')}}">Password</a></li>
                        <li><i class="fa fa-power-off"></i><a href="{{route('logout')}}">Logout</a></li>

                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->

<div id="right-panel" class="right-panel">
    {{--<!-- Header-->--}}

    <header id="header" class="header">
        <div class="header-menu">
            <div class="col-sm-7">
                <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
            </div>
            <div class="col-sm-5">
                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <h4>{{Auth::user()->fullname}}</h4>
                        {{--<img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">--}}
                    </a>

                    <div class="user-menu dropdown-menu">
                        {{--<a class="nav-link" href="#"><i class="fa fa-user"></i> My Profile</a>--}}

                        {{--<a class="nav-link" href="#"><i class="fa fa-user"></i> Notifications <span--}}
                                    {{--class="count">13</span></a>--}}

                        {{--<a class="nav-link" href="#"><i class="fa fa-cog"></i> Settings</a>--}}
                        {{Form::open(['route' => 'logout'])}}
                        <button type="submit" class="nav-link" style="background: transparent; border: none;"><i
                                    class="fa fa-power-off"></i> Logout
                        </button>
                        {{Form::close()}}
                    </div>
                </div>

                <div class="language-select dropdown" id="language-select">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="language" aria-haspopup="true"
                       aria-expanded="true">
                        <i class="flag-icon flag-icon-us"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="language">
                        <div class="dropdown-item">
                            <span class="flag-icon flag-icon-fr"></span>
                        </div>
                        <div class="dropdown-item">
                            <i class="flag-icon flag-icon-es"></i>
                        </div>
                        <div class="dropdown-item">
                            <i class="flag-icon flag-icon-us"></i>
                        </div>
                        <div class="dropdown-item">
                            <i class="flag-icon flag-icon-it"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </header><!-- /header -->
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
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

        @yield('content')

    </div>

    {{--</div> <!-- .content -->--}}
</div><!-- /#right-panel -->

{{--<!-- Right Panel -->--}}

<script src="/js/vendor/jquery-2.1.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="/js/plugins.js"></script>
<script src="/js/main.js"></script>


<script src="/js/lib/chart-js/Chart.bundle.js"></script>
{{--<script src="/js/dashboard.js"></script>--}}
<script src="/js/widgets.js"></script>
<script src="/js/lib/vector-map/jquery.vmap.js"></script>
<script src="/js/lib/vector-map/jquery.vmap.min.js"></script>
<script src="/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
<script src="/js/lib/vector-map/country/jquery.vmap.world.js"></script>
<script>
    (function ($) {
        "use strict";

        jQuery('#vmap').vectorMap({
            map: 'world_en',
            backgroundColor: null,
            color: '#ffffff',
            hoverOpacity: 0.7,
            selectedColor: '#1de9b6',
            enableZoom: true,
            showTooltip: true,
            values: sample_data,
            scaleColors: ['#1de9b6', '#03a9f5'],
            normalizeFunction: 'polynomial'
        });
    })(jQuery);
</script>
@yield('script')

</body>
</html>