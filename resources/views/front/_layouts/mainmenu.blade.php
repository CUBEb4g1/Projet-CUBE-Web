<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<div class="header2 bg-success-gradiant sticky-div">
    <div class="container">
        <nav class="navbar navbar-expand-lg h2-nav">
            <a class="navbar-brand" href="/"><img src="{{ asset_cache('media/favicons/favicon.png') }}" width="50"
                                                  height="50" alt="Ressources Relationnelles"/></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header2"
                    aria-controls="header2" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse hover-dropdown" id="header2">
                <ul class="navbar-nav">
                    <li class="nav-item active"><a class="nav-link" href="/">Accueil</a></li>
                    {{--                        <li class="nav-item dropdown position-relative">--}}
                    {{--                            <a class="nav-link dropdown-toggle" href="#" id="h2-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                    {{--                                Ressources <i class="icon-arrow-down ml-1 font-12"></i>--}}
                    {{--                            </a>--}}
                    {{--                            <ul class="dropdown-menu">--}}
                    {{--                                <li><a class="dropdown-item" href="#">Categorie1</a></li>--}}
                    {{--                                <li><a class="dropdown-item" href="#">Categorie2</a></li>--}}
                    {{--                                <li><a class="dropdown-item" href="#">Categorie3</a></li>--}}
                    {{--                                <li class="divider" role="separator"></li>--}}
                    {{--                                <li><a class="dropdown-item" href="#">Categorie4</a></li>--}}
                    {{--                                <li class="divider" role="separator"></li>--}}
                    {{--                                <li><a class="dropdown-item" href="#">Categorie5</a></li>--}}
                    {{--                                <li class="dropdown-submenu position-relative"> <a class="dropdown-toggle dropdown-item" data-toggle="dropdown" href="#">Categorie6<i class="icon-arrow-right float-right mt-1"></i></a>--}}
                    {{--                                    <ul class="dropdown-menu">--}}
                    {{--                                        <li><a class="dropdown-item" href="#">SousCategorie1</a></li>--}}
                    {{--                                        <li class="dropdown-submenu position-relative"> <a class="dropdown-toggle dropdown-item" href="#" data-toggle="dropdown">SousCategorie2<i class="icon-arrow-right float-right mt-1"></i></a>--}}
                    {{--                                            <ul class="nav navbar-nav dropdown-menu">--}}
                    {{--                                                <li class="dropdown-submenu position-relative"> <a class="dropdown-toggle dropdown-item" href="#" data-toggle="dropdown">Encore<i class="icon-arrow-right float-right mt-1"></i></a>--}}
                    {{--                                                    <ul class="dropdown-menu">--}}
                    {{--                                                        <li><a class="dropdown-item" href="#">Vers</a></li>--}}
                    {{--                                                        <li><a class="dropdown-item" href="#">L'infini</a></li>--}}
                    {{--                                                        <li><a class="dropdown-item" href="#">Et</a></li>--}}
                    {{--                                                        <li class="divider" role="separator"></li>--}}
                    {{--                                                        <li><a class="dropdown-item" href="#">L'au</a></li>--}}
                    {{--                                                        <li class="divider" role="separator"></li>--}}
                    {{--                                                        <li><a class="dropdown-item" href="#">Dela</a></li>--}}
                    {{--                                                    </ul>--}}
                    {{--                                                </li>--}}
                    {{--                                            </ul>--}}
                    {{--                                        </li>--}}
                    {{--                                    </ul>--}}
                    {{--                                </li>--}}
                    {{--                            </ul>--}}
                    {{--                        </li>--}}
                    {{--                        <li class="nav-item"><a class="nav-link" href="#">A propos</a></li>--}}
                    {{--                        <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>--}}
                    <li class="nav-item">
                        @auth()
                            {{--Profile--}}
                            <a href="{{ route('profile') }}" class="nav-link">Mon profil</a>
                        @endauth
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="btn rounded-pill btn-dark py-2 px-4 my-2" href="https://github.com/CUBEb4g1" target="_blank"><i
                                class="far fa-question-circle"></i> Guide</a>
                    </li>
                    <li class="nav-item">
                        @auth()
                            <a href="{{route('front.resourcecreate')}}" class="btn rounded-pill btn-dark py-2 px-4 my-2">
                                Créer une ressource
                            </a>
                        @endauth
                    </li>
                    <li class="nav-item">
                        @auth()
                            <a href="{{ route('logout') }}" class="btn rounded-pill btn-dark py-2 px-4 my-2"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endauth
                        @guest()
                            <a href="{{ route('login') }}"
                               class="btn rounded-pill btn-dark py-2 px-4 my-2">{{ __('Login') }}</a>
                        @endguest
                    </li>
                    <li class="nav-item">
                        @can($ACCESS_BACKOFFICE)
                            {{--Backoffice--}}
                            <a href="{{ route('back.dashboard') }}" class="btn rounded-pill btn-dark py-2 px-4 my-2">
                                {{ __('Administration') }}
                            </a>
                        @endcan
                        @guest()
                            <a class="btn rounded-pill btn-dark py-2 px-4 my-2"
                               href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endguest
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
