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
        <div class="container">
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
                                    <a href="{{ route('back.dashboard') }}" class="btn rounded-pill btn-dark py-2 px-4">
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
    </div>
    @include('front._layouts.banner')
    {{-- Content --}}
	@yield('content')
    {{-- Footer --}}
    <footer class="footer1">
        <div class="f1-topbar p-0">
            <div class="container">
                <!-- Row  -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-lg f1-nav p-0"> <a class="navbar-brand d-block d-md-none" href="/">{{-- Warning, this is a trapped link ahah --}}</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ft1" aria-controls="ft1" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="collapse navbar-collapse" id="ft1">
                                <ul class="navbar-nav">
                                    <li class="nav-item active"><a class="nav-link d-block" href="/">Accueil</a></li>
                                    <li class="nav-item"><a class="nav-link d-block" href="#">Ressources</a></li>
                                    <li class="nav-item"><a class="nav-link d-block" href="#">A propos</a></li>
                                    <li class="nav-item"><a class="nav-link d-block" href="{{ route('contact') }}">Contact</a></li>
                                    <li class="nav-item"><a class="nav-link d-block" href="#">Guide</a></li>
                                    <li class="nav-item">
                                        @if (Auth::check())
                                            {{--Logout--}}
                                            <a href="{{ route('logout') }}" class="nav-link d-block" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                        @else
                                            {{--Login--}}
                                            <a href="{{ route('login') }}" class="nav-link d-block">{{ __('Login') }}</a>
                                        @endif
                                    </li>
                                    <li class="nav-item">
                                        @if (Auth::check())
                                            {{--Checking rights--}}
                                            @can($ACCESS_BACKOFFICE)
                                                {{--Backoffice--}}
                                                <a href="{{ route('back.dashboard') }}" class="nav-link d-block">
                                                    {{ __('Administration') }}
                                                </a>
                                            @endcan
                                        @else
                                            {{--Register--}}
                                            <a class="nav-link d-block" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        @endif
                                    </li>
                                </ul>
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item"><a class="nav-link text-dark text-uppercase" href="{{ route('contact') }}"><i class="fas fa-envelope-open-text text-danger font-20 mr-2"></i>Contactez-nous !</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <!-- Column -->
                </div>
            </div>
        </div>
        <!-- Row  -->
        <div class="f1-middle py-4">
            <div class="container">
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <a href="/"><img src="{{ asset_cache('media/favicons/favicon.png') }}" width="90" height="90" alt="Ressources Relationnelles" /></a>
                        <p class="mt-3">Rejoignez-nous aussi sur mobile pour ne jamais perdre de vue vos nouveaux contacts !</p>
                        <a href="/"><img src="{{ asset_cache('media/logos/app-store.svg') }}" alt="Apple Store" /></a>
                        <a href="/"><img src="{{ asset_cache('media/logos/google-play.svg') }}" alt="Google Play" /></a>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="d-flex mb-2 mt-3">
                            <div class="display-7 mr-3 align-self-top"><i class="icon-location-pin"></i></div>
                            <div class="info">
                                <span class="font-weight-medium mt-3"><h6>Siege social</h6></span><br/>
                                <p class="mt-3">91 Grande Rue<br/>70100 - Gray<br/>FRANCE</p>
                            </div>
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <div class="display-7 mr-3 align-self-top"><i class="icon-phone"></i></div>
                            <div class="info">
                                <span class="font-weight-medium mt-2">+33 642 780 170</span>
                            </div>
                        </div>
                        <div class="d-flex mb-3 align-items-center">
                            <div class="display-7 mr-3 align-self-top"><i class="icon-envelope-open"></i></div>
                            <div class="info">
                                <a href="#" class="font-weight-medium text-decoration-none link-special mt-2">info@r2sources.com</a>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-6 col-md-12 m-t-5">
                        <h6 class="font-weight-medium mt-3">L'aventure</h6>
                        <ul class="general-listing two-part with-arrow mt-2 list-inline">
                            <li><a href="#" class="text-decoration-none d-flex py-2 align-items-center"><i class="icon-arrow-right mr-1"></i> A propos</a></li>
                            <li><a href="#" class="text-decoration-none d-flex py-2 align-items-center"><i class="icon-arrow-right mr-1"></i> Confidentialite</a></li>
                            <li><a href="#" class="text-decoration-none d-flex py-2 align-items-center"><i class="icon-arrow-right mr-1"></i> Support</a></li>
                            <li><a href="#" class="text-decoration-none d-flex py-2 align-items-center"><i class="icon-arrow-right mr-1"></i> Jobs</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row  -->
        <div class="f1-bottom-bar py-3">
            <div class="container">
                <div class="d-flex">
                    <div class="my-2">© {{ now()->year }} <a href="https://phoenixia-prods.com" target="_blank" class="link p-2">Phoenixia Productions</a> Tous droits reserves.</div>
                    <div class="links ml-auto my-2">
                        <a href="https://github.com/CUBEb4g1/Projet-CUBE-Web" target="_blank" class="link p-2"><i class="fab fa-github"></i></a>
                        <a href="#" class="link p-2"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="link p-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="link p-2"><i class="fab fa-google "></i></a>
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
