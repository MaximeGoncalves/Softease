@extends('base')
@section('content')
    <div class="header">
        <h1>Blog</h1>
    </div>
    <div class="container">
        {{--LISTES DES ARTICLES--}}
        <div class="row mt-5">
            <div class="col-8">
                @for($i=0; $i<3 ; $i++ )
                    <div class="article">
                        <div class="article-img">
                            <img src="img/blog.jpg" alt="" width="100%">

                        </div>
                        <div class="article-date">
                            <strong class="day">9</strong>
                            <p>Août 2018</p>
                        </div>
                        <div class="article-title">
                            <h3>Lorem ipsum</h3>
                        </div>
                        <div class="article-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At error facere hic magni
                                molestias
                                odit officiis sequi similique sit suscipit. Iste magni maxime nostrum obcaecati
                                perspiciatis
                                veritatis. Ad, facilis, quibusdam! Accusamus enim esse incidunt labore porro
                            possimus
                            quo, reprehenderit sunt? Commodi deserunt dolorem facilis fugit laudantium omnis, quaerat
                            repellat repellendus reprehenderit totam? Beatae consectetur et modi sint? Ab, doloremque
                            labore.
                            </p>
                        </div>
                        <div class="article-button">
                            <a class="btn btn-softease">More ...</a>
                        </div>
                    </div>
                    <hr class="mb-5">

                    <div class="article">
                        <div class="article-img">
                            <img src="img/blog2.png" alt="" width="100%">

                        </div>
                        <div class="article-date">
                            <strong class="day">9</strong>
                            <p>Août 2018</p>
                        </div>
                        <div class="article-title">
                            <h3>Lorem ipsum</h3>
                        </div>
                        <div class="article-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At error facere hic magni
                                molestias
                                odit officiis sequi similique sit suscipit. Iste magni maxime nostrum obcaecati
                                perspiciatis
                                veritatis. Ad, facilis, quibusdam!</><>Accusamus enim esse incidunt labore porro
                            possimus
                            quo, reprehenderit sunt? Commodi deserunt dolorem facilis fugit laudantium omnis, quaerat
                            repellat repellendus reprehenderit totam? Beatae consectetur et modi sint? Ab, doloremque
                            labore.
                            </p>
                        </div>
                        <div class="article-button">
                            <a class="btn btn-softease">More ...</a>
                        </div>
                    </div>
                    <hr class="mb-5">
                @endfor
            </div>


            {{--SIDE BAR--}}
            <div class="col-4 pl-3">
                <h3>Derniers articles</h3>
                <hr>
                <div class="side-bar">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="side-bar-img">
                                <img src="img/blog.jpg" alt="" width="100%">
                            </div>
                        </div>
                        <div class="col">
                            <div class="side-bar-title">
                                <strong>Lorem ipsum</strong>
                            </div>
                            <div class="side-bar-date"> <small> <i class="fas fa-clock"></i> 9 Août 2018</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="side-bar-img">
                                <img src="img/blog2.png" alt="" width="100%">
                            </div>
                        </div>
                        <div class="col">
                            <div class="side-bar-title">
                                <strong>Lorem ipsum</strong>
                            </div>
                            <div class="side-bar-date"> <small> <i class="fas fa-clock"></i> 9 Août 2018</small>
                            </div>
                        </div>
                    </div>

                    <div class="side-bar-category">
                        <h3 class="mt-5">Categories</h3>
                        <hr>
                        <a href="#" class="d-block">Laravel (5)</a>
                        <a href="#" class="d-block">CSS (3)</a>
                        <a href="#" class="d-block">PHP (2)</a>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection