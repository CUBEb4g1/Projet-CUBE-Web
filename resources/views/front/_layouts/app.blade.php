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
    {{--Scripts--}}
    <script></script>
</head>
<body id="top">
	@include('_partials.maintenance_ribbon')
	@include('_partials.switched-auth-warning')
    <div class="header2 bg-success-gradiant sticky-div">
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
    {{-- Content --}}
	@yield('content')
    {{-- Back to Top Button --}}
    @include('front._partials._back_to_top')
    {{-- Footer --}}
    @include('front._layouts.footer')
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
    {{-- Sticky menu script cheat --}}
    <script>
        stickyElem =
            document.querySelector(".sticky-div");
        /* Gets the amount of height of the element from the viewport and adds the pageYOffset to get the height relative to the page */
        currStickyPos =
            stickyElem.getBoundingClientRect().top + window.pageYOffset;
        window.onscroll = function() {
            /* Check if the current Y offset is greater than the position of the element */
            if (window.pageYOffset > currStickyPos) {
                stickyElem.style.position = "fixed";
                stickyElem.style.top = "0px";
                stickyElem.style.left = "0px";
                stickyElem.style.right = "0px";
            } else {
                stickyElem.style.position = "relative";
                stickyElem.style.top = "initial";
            }
        }
    </script>
    {{-- Dark Mode Switch -- Not yet implemented but will be --}}
    <script>
        (function($) { "use strict";
            $(".switch").on('click', function () {
                if ($("body").hasClass("light")) {
                    $("body").removeClass("light");
                    $(".switch").removeClass("switched");
                }
                else {
                    $("body").addClass("light");
                    $(".switch").addClass("switched");
                }
            });
            {{-- Back to Top button --}}
            $(document).ready(function(){"use strict";
                var progressPath = document.querySelector('.progress-wrap path');
                var pathLength = progressPath.getTotalLength();
                progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
                progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
                progressPath.style.strokeDashoffset = pathLength;
                progressPath.getBoundingClientRect();
                progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
                var updateProgress = function () {
                    var scroll = $(window).scrollTop();
                    var height = $(document).height() - $(window).height();
                    var progress = pathLength - (scroll * pathLength / height);
                    progressPath.style.strokeDashoffset = progress;
                }
                updateProgress();
                $(window).scroll(updateProgress);
                var offset = 50;
                var duration = 550;
                jQuery(window).on('scroll', function() {
                    if (jQuery(this).scrollTop() > offset) {
                        jQuery('.progress-wrap').addClass('active-progress');
                    } else {
                        jQuery('.progress-wrap').removeClass('active-progress');
                    }
                });
                jQuery('.progress-wrap').on('click', function(event) {
                    event.preventDefault();
                    jQuery('html, body').animate({scrollTop: 0}, duration);
                    return false;
                })
            });
        })(jQuery);
    </script>
    @stack('scripts')
</body>
</html>
