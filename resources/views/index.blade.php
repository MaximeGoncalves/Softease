@extends('base')
@section('content')
<header>
    <div class="container h-100">
        <div class="title justify-content-center">
            <h1 class="mt-lg-5 vertical-center">Softease<span class="primary">.</span></h1>
            <h2>$('.Vos-idées').on('change', function(idée){return La-Solution});</h2>
            <a class="header_button text-center">Une question ?</a>
        </div>
    </div>
</header>
<main>
    <section class="first bg-primary-softease">
        <div class="container content">
            <h2 class="text-center">Nos Services</h2>
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <p><i class="fab fa-wordpress"></i></p>
                    <h3>CMS</h3>
                    <p>Grâce au CMS, il vous sera possible d'administrer vous même un certain nombre d'élements sur
                        votre site. Ajouter des articles, des images...</p>
                </div>

                <div class="col-xs-12 col-sm-4">
                    <p><i class="fas fa-cloud"></i></p>
                    <h3>De A à Z</h3>
                    <p>Du nom de domaine, en passant par l’hébergement jusqu'a réception de votre site internet.
                        Nous nous occupons de tout !.</p>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <p><i class="fas fa-code"></i></p>
                    <h3>Applicatif web</h3>
                    <p>Vous avez besoin d'une application web pour dématérialisé et archiver votre travail.
                        N'hésitez plus, nous développons pour vous l'application web qui satisfait 100% de vos
                        besoins.</p>
                </div>
            </div>
        </div>
        </div>
    </section>
    <section class="second">
        <div class="container content">
            <div class="row">
                <div class="col-xs-12 col-sm-5 align-items-center">
                    <h2>Nos Outils</h2>
                    <p>Nous utilison divers outils pour pouvoir répondre a chacun de vos besoins</p>
                </div>
                <div class="col-xs-12 col-sm-7 ">
                    <div class="row justify-content-center">
                        <img src="img/soft/laravel.png" alt="laravel">
                        <img src="img/soft/php.png" alt="php">
                        <img src="img/soft/wordpress.png" alt="wordpress">
                        <img src="img/soft/sql.png" alt="sql"><br>
                    </div>
                    <div class="row mt-sm-3 justify-content-center">
                        <img src="img/soft/html.png" alt="laravel">
                        <img src="img/soft/css.png" alt="laravel">
                        <img src="img/soft/js.png" alt="laravel">
                        <img src="img/soft/sass.png" alt="laravel">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="third">
        <div class="container content">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                </div>
                <div class="col-xs-12 col-lg-8 bg-white border-radius p-5">
                    <h2 class="primary">Tout Responsive !</h2>
                    <p> Sur mobile, tablette ou grand écran, tout est parfaitement optimisé grâce au Responsive Web
                        Design, notre
                        spécialité !</p>

                    <p> Tous ces smartphones et tablettes qui nous entourent sont de nouveaux enjeux pour un web
                        universel, partout,
                        au doigt et à la souris, des petits aux grands écrans.
                        Partout, tout le temps</p>

                    <p> Aujourd'hui, nous abordons le web de multiples façons : on découvre un site sur sa tablette,
                        puis on passe
                        une commande au bureau pour finir par suivre son évolution sur mobile.</p>

                    <p>Un sacré défi, n'est-ce pas ?
                        Le Responsive Web Design est notre spécialité</p>

                    <p>Nous testons de manière avancée sur les plates-formes du marché (notamment iOS et Android) pour
                        revivre au
                        mieux l'expérience de l'utilisateur final et adapter design, intégration, développements et
                        performances.</p>

                </div>
            </div>
        </div>
    </section>

    <section class="four">
        <div class="container">
            <div class="row">
                <h3>Développement web</h3>
            </div>

            <div class="row">
                <p>Tout faire fonctionner ensemble : c'est ici qu'interviennent nos solutions complètes et robustes de
                    système de gestion de contenu (CMS) qui vous permettent d'être totalement autonome dès la mise en
                    ligne de votre site.</p>

                <p>Nous développons également des applications web évoluées et performantes, des PWA (Progressive Web
                    Apps), avec bases de données et modules dynamiques pour répondre à des besoins spécifiques. Nos
                    technologies préférées : HTML5, PHP, MySQL, JavaScript et les formats ouverts.</p>
            </div>
        </div>
    </section>

    <section class="five bg-primary-softease">
        <div class="container">
            <div class="row">
                <div class="col"><h3>Vous cherchez un webmaster ?</h3></div>
                <div class="col">
                    <button class="btn-softease float-right">Contacter nous !</button>
                </div>
            </div>
        </div>
    </section>
</main>
    @endsection