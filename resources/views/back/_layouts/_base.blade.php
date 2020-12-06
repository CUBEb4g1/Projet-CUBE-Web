<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}"/>
	<meta name="robots" content="noindex, nofollow">

	<title>@hasSection('title')@yield('title') - @endif{{ config('app.name') }} | {{ __('Administration') }}</title>

	<!-- Icons -->
	<link rel="shortcut icon" href="{{ asset_cache('media/favicons/favicon.png') }}">

	<!-- Stylesheets -->
	@stack('styles')
</head>
<body id="@yield('body__id')" class="@yield('body__class')">
	@yield('body')

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
	@stack('scripts')
</body>
</html>
