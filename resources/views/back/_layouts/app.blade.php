@extends('back._layouts._base')

@push('styles')
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link rel="stylesheet" id="css-vendor" href="{{ mix('css/back/vendor.css') }}">
	<link rel="stylesheet" id="css-app" href="{{ mix('css/back/app.css') }}">
@endpush

@section('body__class', 'navbar-top')
@section('body')
	@include('_partials.maintenance_ribbon')
	@include('_partials.switched-auth-warning')

	{{-- Main navbar --}}
	<div class="navbar navbar-expand-md navbar-light fixed-top">

		{{-- Header with logos --}}
		<div class="navbar-header navbar-dark d-none d-md-flex align-items-md-center">
			<div class="navbar-brand navbar-brand-md">
				<a href="{{ route('back.dashboard') }}">
					<img src="{{ asset_cache('media/logos/logo-light.svg') }}" alt="">
					<span>{!! config('app.name') !!}</span>
				</a>
			</div>

			<div class="navbar-brand navbar-brand-xs">
				<a href="{{ route('back.dashboard') }}">
					<img src="{{ asset_cache('media/logos/logo-light.svg') }}" alt="">
				</a>
			</div>
		</div>
		{{-- /header with logos --}}

		{{-- Mobile controls --}}
		<div class="d-flex flex-1 d-md-none">
			<div class="navbar-brand mr-auto">
				<a href="{{ route('back.dashboard') }}">
					<img src="{{ asset_cache('media/logos/logo-dark.svg') }}" alt="">
					<span>{!! config('app.name') !!}</span>
				</a>
			</div>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="fas fa-ellipsis-v"></i>
			</button>

			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="fas fa-bars"></i>
			</button>
		</div>
		{{-- /mobile controls --}}


		{{-- Navbar content --}}
		<div class="collapse navbar-collapse" id="navbar-mobile">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
						<i class="fas fa-bars"></i>
					</a>
				</li>
			</ul>

			<ul class="navbar-nav ml-auto">
				{{--<li class="nav-item dropdown">
					<a href="#" class="navbar-nav-link">
						<i class="icon-bell2"></i>
						<span class="d-md-none ml-2">Notifications</span>
						<span class="badge badge-mark border-white"></span>
					</a>
				</li>--}}

				<li class="nav-item dropdown dropdown-user">
					<span class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
						<img src="{{ asset_cache(Auth::user()->getAvatar('xs')) }}" class="rounded-circle mr-2" style="object-fit: cover;" width="34" height="34" alt="">
						<span>{{ Auth::user()->firstname ?? Auth::user()->username }}</span>
					</span>

					<div class="dropdown-menu dropdown-menu-right">
						<a href="{{ route('home') }}" class="dropdown-item">
							<i class="fas fa-home-alt fa-fw"></i> {{ __('Back to the site') }}
						</a>
						<div class="dropdown-divider"></div>
						<a href="{{ route('back.account.parameters') }}" class="dropdown-item">
							<i class="fas fa-cog fa-fw"></i> {{ __('Parameters') }}
						</a>
						<form action="{{ route('logout') }}" method="post">
							@csrf
							<button class="btn btn-link dropdown-item">
								<i class="fas fa-power-off fa-fw"></i>
								{{ __('Logout') }}
							</button>
						</form>
					</div>
				</li>
			</ul>
		</div>
		{{-- /navbar content --}}

	</div>
	{{-- /main navbar --}}


	{{-- Page content --}}
	<div class="page-content">

		{{-- Main sidebar --}}
		<div class="sidebar sidebar-dark sidebar-main sidebar-fixed sidebar-expand-md">

			{{-- Sidebar mobile toggler --}}
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-main-toggle">
					<i class="fas fa-arrow-left"></i>
				</a>
				Navigation
				<a href="#" class="sidebar-mobile-expand">
					<i class="far fa-expand-wide"></i>
					<i class="far fa-compress-wide"></i>
				</a>
			</div>
			{{-- /sidebar mobile toggler --}}


			{{-- Sidebar content --}}
			<div class="sidebar-content">

				{{-- User menu --}}
				<div class="sidebar-user">
					<div class="card-body">
						<div class="media">
							<div class="mr-3">
								<span><img src="{{ asset_cache(Auth::user()->getAvatar('xs')) }}" width="38" height="38" class="rounded-circle" style="object-fit: cover;" alt=""></span>
							</div>

							<div class="media-body">
								<div class="media-title font-weight-semibold">{{ Auth::user()->firstname ?? Auth::user()->username }}</div>
							</div>

							<div class="ml-3 align-self-center">
								<a href="{{ route('back.account.parameters') }}" class="text-white"><i class="far fa-cog"></i></a>
							</div>
						</div>
					</div>
				</div>
				{{-- /user menu --}}


				{{-- Main navigation --}}
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">

						{{-- Main --}}
						<li class="nav-item">
							<a href="{{ route('back.dashboard') }}" class="nav-link {{ hlrt_is('back.dashboard') }}">
								<i class="nav-main-link-icon far fa-tachometer-alt-slow fa-fw"></i>
								<span>{{ __('Dashboard') }}</span>
							</a>
						</li>
						{{-- CMS --}}
						<li class="nav-item-header">
							<div class="text-uppercase font-size-xs line-height-xs">CMS</div>
							<i class="far fa-ellipsis-h" title="CMS"></i>
						</li>
						<li class="nav-item">
							<a href="{{ route('back.page.list') }}" class="nav-link {{ hlrt_begins_with('back.page') }}">
								<i class="nav-main-link-icon fas fa-layer-group fa-fw"></i>
								<span>{{ __('Pages') }}</span>
							</a>
						</li>
						{{-- Users --}}
						<li class="nav-item-header">
							<div class="text-uppercase font-size-xs line-height-xs">{{ __('Users') }}</div>
							<i class="far fa-ellipsis-h" title="{{ __('Users') }}"></i>
						</li>
						<li class="nav-item">
							<a href="{{ route('back.user.list') }}" class="nav-link {{ hlrt_begins_with('back.user') }}">
								<i class="nav-main-link-icon fal fa-user fa-fw"></i>
								<span>{{ __('Users') }}</span>
							</a>
						</li>
						@can($DEV)
							<li class="nav-item nav-item-submenu {{ hlrt_begins_with(['back.role', 'back.permission'], 'nav-item-expanded nav-item-open') }}">
								<a href="#" class="nav-link"><i class="fal fa-graduation-cap fa-fw"></i> <span>{{ __('Roles') }} & {{ __('Permissions') }}</span></a>

								<ul class="nav nav-group-sub" data-submenu-title="{{ __('Roles') }} & {{ __('Permissions') }}">
									<li class="nav-item">
										<a href="{{ route('back.role.list') }}" class="nav-link {{ hlrt_begins_with('back.role') }}">
											{{ __('Roles') }}
										</a>
									</li>
									<li class="nav-item">
										<a href="{{ route('back.permission.list') }}" class="nav-link {{ hlrt_begins_with('back.permission') }}">
											{{ __('Permissions') }}
										</a>
									</li>
								</ul>
							</li>
						@endcan
						{{-- Apparence --}}
						<li class="nav-item-header">
							<div class="text-uppercase font-size-xs line-height-xs">{{ __('Appearance') }}</div>
							<i class="far fa-ellipsis-h" title="{{ __('Appearance') }}"></i>
						</li>
						<li class="nav-item">
							<a href="{{ route('back.menu.list') }}" class="nav-link {{ hlrt_begins_with('back.menu') }}">
								<i class="nav-main-link-icon fal fa-bars fa-fw"></i>
								<span>{{ __('Menus') }}</span>
							</a>
						</li>
						@can($DEV)
							{{-- Settings --}}
							<li class="nav-item-header">
								<div class="text-uppercase font-size-xs line-height-xs">{{ __('Settings') }}</div>
								<i class="far fa-ellipsis-h" title="{{ __('Settings') }}"></i>
							</li>
							<li class="nav-item">
								<a href="{{ route('back.settings.parameters') }}" class="nav-link" {{ hlrt_begins_with('back.settings') }}>
									<i class="nav-main-link-icon fal fa-tools fa-fw"></i>
									<span>{{ __('Parameters') }}</span>
								</a>
							</li>
						@endcan
						{{-- /main --}}

					</ul>
				</div>
				{{-- /main navigation --}}

			</div>
			{{-- /sidebar content --}}

		</div>
		{{-- /main sidebar --}}


		{{-- Main content --}}
		<div class="content-wrapper">

			{{--Page Content--}}
			@yield('content')
			{{--/page Content--}}

			{{-- Footer --}}
			<div class="navbar navbar-expand-lg navbar-light">
				<div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy; <span data-toggle="year-copy">{{ date('Y') }}</span> {!! config('app.name') !!}
					</span>
				</div>
			</div>
			{{-- /footer --}}

		</div>
		{{-- /main content --}}

	</div>
	{{-- /page content --}}
@endsection

@prepend('scripts')
	<script src="{{ mix('js/back/app.js') }}"></script>
@endprepend
