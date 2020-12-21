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
    {{--Search Bar--}}
    <div class="ms_header">
        <div class="ms_top_left">
            <div class="ms_top_search">
                <input type="text" class="form-control" placeholder="Chercher une ressource..">
                <span class="search_icon">
							<img src="{{ asset('/media/front/search.svg') }}" alt="">
						</span>
            </div>
        </div>
        {{--Menu--}}
        <div class="ms_top_right">
            <div class="ms_top_lang">
                <a href="/" class="ms_btn_light">{{ config('app.name', 'Laravel') }}</a>
                <a href="{{ route('contact') }}" class="ms_btn_light">Contact{{-- __('Contact form') --}}</a>
                {{--Multi languages -- Temporarily first lane out of the box !!!--}}
                <span data-toggle="modal" data-target="#lang_modal">Langue <img src="{{ asset('/media/front/lang.svg') }}" alt=""></span>
                @if (count(LaravelLocalization::getSupportedLocales()) > 1)
                    @foreach(LaravelLocalization::getLocalesOrder() as $localeCode => $properties)
                        <small>
                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        </small>
                    @endforeach
                @endif
            </div>
            <div class="ms_top_btn">
                @guest
                    {{--Register--}}
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ms_btn reg_btn">{{ __('Register') }}</a>
                    @endif
                    {{--Login--}}
                    <a href="{{ route('login') }}" class="ms_btn login_btn">{{ __('Login') }}</a>
                @else
                    @can($ACCESS_BACKOFFICE)
                        {{--Backoffice--}}
                        <a href="{{ route('back.dashboard') }}" class="ms_btn reg_btn">
                            {{ __('Administration') }}
                        </a>
                    @endcan
                    {{--Logout--}}
                    <a href="{{ route('logout') }}" class="ms_btn login_btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
            </div>
        </div>
    </div>
    {{--Content--}}
	@yield('content')
    {{--Footer -- Need to be included instead of @include method !!! --}}
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
	@stack('scripts')
</body>
</html>
