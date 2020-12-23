<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	@stack('meta')
	<title>@hasSection('title')@yield('title') - @endif{{ config('app.name') }}</title>
	{{-- Favicon --}}
	<link rel="icon" type="image/png" href="{{ asset_cache('media/favicons/favicon.png') }}"/>
	{{--Fonts--}}
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
	{{--Styles--}}
	<link href="{{ mix('css/front/vendor.css') }}" rel="stylesheet">
	<link href="{{ mix('css/front/app.css') }}" rel="stylesheet">
	@stack('styles')
    <script>

    </script>
</head>
<body>
	@include('_partials.maintenance_ribbon')
	@include('_partials.switched-auth-warning')
    <div class="header2 bg-success-gradiant">
        <nav class="navbar navbar-expand-lg h2-nav">
            <a class="navbar-brand" href="/"><img src="{{ asset_cache('media/favicons/favicon.png') }}" width="50" height="50" alt="Ressources Relationnelles" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header2" aria-controls="header2" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse hover-dropdown" id="header2">
                <ul class="navbar-nav">
                    <li class="nav-item active"><a class="nav-link" href="/">Accueil</a></li>
                    <li class="nav-item dropdown position-relative">
                        <a class="nav-link dropdown-toggle" href="#" id="h2-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ressources <i class="icon-arrow-down ml-1 font-12"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Categorie1</a></li>
                            <li><a class="dropdown-item" href="#">Categorie2</a></li>
                            <li><a class="dropdown-item" href="#">Categorie3</a></li>
                            <li class="divider" role="separator"></li>
                            <li><a class="dropdown-item" href="#">Categorie4</a></li>
                            <li class="divider" role="separator"></li>
                            <li><a class="dropdown-item" href="#">Categorie5</a></li>
                            <li class="dropdown-submenu position-relative"> <a class="dropdown-toggle dropdown-item" data-toggle="dropdown" href="#">Categorie6<i class="icon-arrow-right float-right mt-1"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">SousCategorie1</a></li>
                                    <li class="dropdown-submenu position-relative"> <a class="dropdown-toggle dropdown-item" href="#" data-toggle="dropdown">SousCategorie2<i class="icon-arrow-right float-right mt-1"></i></a>
                                        <ul class="nav navbar-nav dropdown-menu">
                                            <li class="dropdown-submenu position-relative"> <a class="dropdown-toggle dropdown-item" href="#" data-toggle="dropdown">Encore<i class="icon-arrow-right float-right mt-1"></i></a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">Vers</a></li>
                                                    <li><a class="dropdown-item" href="#">L'infini</a></li>
                                                    <li><a class="dropdown-item" href="#">Et</a></li>
                                                    <li class="divider" role="separator"></li>
                                                    <li><a class="dropdown-item" href="#">L'au</a></li>
                                                    <li class="divider" role="separator"></li>
                                                    <li><a class="dropdown-item" href="#">Dela</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">A propos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="btn rounded-pill btn-dark py-2 px-4" href="#"><i class="far fa-question-circle"></i> Guide</a></li>
                    <li class="nav-item">
                        @if (Auth::check())
                            {{--Logout--}}
                            <a href="{{ route('logout') }}" class="btn rounded-pill btn-dark py-2 px-4" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        @else
                            {{--Login--}}
                            <a href="{{ route('login') }}" class="btn rounded-pill btn-dark py-2 px-4">{{ __('Login') }}</a>
                        @endif
                    </li>
                    <li class="nav-item">
                        @if (Auth::check())
                            {{--Checking rights--}}
                            @can($ACCESS_BACKOFFICE)
                                {{--Backoffice--}}
                                <a href="{{ route('back.dashboard') }}" class="ms_btn reg_btn">
                                    {{ __('Administration') }}
                                </a>
                            @endcan
                        @else
                            {{--Register--}}
                            <a class="btn rounded-pill btn-dark py-2 px-4" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    @include('front._layouts.banner')
    {{--Content--}}
	@yield('content')
    {{--Footer -- Need to be included instead of @include method !!! --}}
    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <address>
                            <p>91 Grande Rue,</p>
                            <p class="mb-4">70100 GRAY</p>
                            <div class="d-flex align-items-center">
                                <p class="mr-4 mb-0">+33 642 780 170</p>
                                <a href="#" class="footer-link">info@yourmail.com</a>
                            </div>
                        </address>
                        <div class="social-icons">
                            <h6 class="footer-title font-weight-bold">Partagez sur les reseaux</h6>
                            <div class="d-flex">
                                <a href="#"><i class="fab fa-github"></i></a>
                                <a href="#"><i class="fab fa-facebook"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-google "></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="footer-title">Navigation</h6>
                                <ul class="list-footer">
                                    <li><a href="/" class="footer-link">Accueil</a></li>
                                    <li><a href="#" class="footer-link">Contact</a></li>
                                    <li><a href="{{ route('register') }}" class="footer-link">S'inscrire</a></li>
                                    <li><a href="{{ route('login') }}" class="footer-link">Se connecter</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <h6 class="footer-title">Services</h6>
                                <ul class="list-footer">
                                    <li><a href="#" class="footer-link">Mon profil</a></li>
                                    <li><a href="#" class="footer-link">Mes amis</a></li>
                                    <li><a href="#" class="footer-link">Mes ressources</a></li>
                                    <li><a href="#" class="footer-link">Recherche</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <h6 class="footer-title">L'aventure</h6>
                                <ul class="list-footer">
                                    <li><a href="#" class="footer-link">A propos</a></li>
                                    <li><a href="#" class="footer-link">Confidentialite</a></li>
                                    <li><a href="#" class="footer-link">Support</a></li>
                                    <li><a href="#" class="footer-link">Jobs</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 text-small pt-1">© 2020 <a href="https://phoenixia-prods.com" class="text-white" target="_blank">Phoenixia Productions</a>. Tous droits reserves.</p>
                    </div>
                    <div>
                        <div class="d-flex">
                            <a href="#" class="text-small text-white mx-2 footer-link">Confidentialite </a>
                            <a href="#" class="text-small text-white mx-2 footer-link">Support </a>
                            <a href="#" class="text-small text-white mx-2 footer-link">Jobs </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
	{{--Scripts--}}
	<script>
		var APP        = {};
		APP.csrf_token = '{{ csrf_token() }}';
		APP.notify     = {
			info: '{{ Session::get('infoNotif') }}',
			success: '{{ Session::get('successNotif') }}',
			warning: '{{ Session::get('warningNotif') }}',
			danger: '{{ Session::get('dangerNotif') }}',
		};
	</script>
	<script src="{{ mix('js/front/app.js') }}"></script>
	@stack('scripts')
</body>
</html>
