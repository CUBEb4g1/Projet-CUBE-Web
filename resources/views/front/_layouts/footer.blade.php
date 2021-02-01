<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
                                {{--                                <li class="nav-item"><a class="nav-link d-block" href="#">Ressources</a></li>--}}
                                {{--                                <li class="nav-item"><a class="nav-link d-block" href="#">A propos</a></li>--}}
                                {{--                                <li class="nav-item"><a class="nav-link d-block" href="{{ route('contact') }}">Contact</a></li>--}}
                                <li class="nav-item">
                                    @auth ()
                                        {{--Profile--}}
                                        <a href="{{ route('profile') }}" class="nav-link d-block">Mon profil</a>
                                    @endauth
                                </li>
                                <li class="nav-item"><a class="nav-link d-block" href="https://github.com/CUBEb4g1" target="_blank">Guide</a></li>
                                <li class="nav-item">
                                    @auth()
                                        <a href="{{ route('logout') }}" class="nav-link d-block"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    @endauth
                                    @guest()
                                        <a href="{{ route('login') }}"
                                           class="nav-link d-block">{{ __('Login') }}</a>
                                    @endguest
                                </li>
                                <li class="nav-item">
                                    @can($ACCESS_BACKOFFICE)
                                        {{--Backoffice--}}
                                        <a href="{{ route('back.dashboard') }}" class="nav-link d-block">
                                            {{ __('Administration') }}
                                        </a>
                                    @endcan
                                    @guest(){{--Register--}}
                                        <a class="nav-link d-block"
                                           href="{{ route('register') }}">{{ __('Register') }}</a>
                                    @endguest
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
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex mb-2 mt-3">
                        <div class="display-7 mr-3 align-self-top"><i class="icon-location-pin"></i></div>
                        <div class="info">
                            <span class="font-weight-medium mt-3"><h6>Siège social</h6></span><br/>
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
                <div class="col-lg-6 col-md-12 m-t-5">
                    <h6 class="font-weight-medium mt-3">L'aventure</h6>
                    <ul class="general-listing two-part with-arrow mt-2 list-inline">
                        <li><a href="{{ route('aboutus') }}" class="text-decoration-none d-flex py-2 align-items-center"><i class="icon-arrow-right mr-1"></i> A propos</a></li>
                        <li><a href="{{ route('confidentiality') }}" class="text-decoration-none d-flex py-2 align-items-center"><i class="icon-arrow-right mr-1"></i> Confidentialité</a></li>
                        <li><a href="#" class="text-decoration-none d-flex py-2 align-items-center"><i class="icon-arrow-right mr-1"></i> Support</a></li>
                        <li><a href="#" class="text-decoration-none d-flex py-2 align-items-center"><i class="icon-arrow-right mr-1"></i> Jobs</a></li>
                        <li>
                            @auth ()
                                {{--Profile--}}
                                <a href="{{ route('profile') }}" class="text-decoration-none d-flex py-2 align-items-center"><i class="icon-arrow-right mr-1"></i> Mon profil</a>
                            @endauth
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Row  -->
    <div class="f1-bottom-bar py-3">
        <div class="container">
            <div class="d-flex">
                <div class="my-2">© {{ now()->year }} <a href="https://phoenixia-prods.com" target="_blank" class="link p-2">Phoenixia Productions</a> Tous droits réservés.</div>
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
