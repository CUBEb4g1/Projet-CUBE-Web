<?php /*
@include('back._partials.page_header', [
	'title' => 'Users',

	'subtitle' => 'List',

	'breadcrumb' => [
		[
			'text' => 'Users',
			'url' => route('foo.bar'),
		], [
			'text' => 'List',
		]
	],

	'headerLinks' => [
		[
			'text' => 'Statistics',
			'url' => '#',
			'icon' => 'fas fa-wifi',
		], [
			'text' => 'Invoices',
			'url' => '#',
			'icon' => 'fas fa-calculator',
		], [
			'text' => 'Schedule',
			'url' => '#',
			'icon' => 'fas fa-calendar-alt',
		]
	],

	'navbarLinks' => [
		[
			'text' => 'Support',
			'url' => '#',
		], [
			'text' => 'Settings',
			'icon' => 'fas fa-cog',
			'submenu' => [
				[
					'text' => 'Account',
					'url' => '#',
					'icon' => 'fas fa-user',
					'divider' => true,
				], [
					'text' => 'Analytics',
					'url' => '#',
					'icon' => 'fas fa-analytics',
				]
			]
		]
	]
])
 */ ?>

<div class="page-header page-header-light">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4><span class="font-weight-semibold">{{ $title }}</span> {{ isset($subtitle) ? '- '.$subtitle : '' }}</h4>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="fas fa-ellipsis-v"></i></a>
		</div>

		<div class="header-elements d-none">
			<div class="d-flex justify-content-center">
				{{ $header ?? null }}
				@foreach ($headerLinks ?? [] as $link)
					<a href="{{ $link['url'] }}" class="btn btn-link btn-float text-default"><i class="{{ $link['icon'] }} fa-lg text-primary"></i><span>{!! $link['text'] !!}</span></a>
				@endforeach
			</div>
		</div>
	</div>

	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				@foreach (Breadcrumb::current() as $link)
					@if (isset($link['route']))
						@if (!$loop->last)
							<a href="{{ route($link['route']) }}" class="breadcrumb-item">
								@if (isset($link['icon']))<i class="{{ $link['icon'] }} mr-1"></i>@endif
								{!! __($link['text']) !!}
							</a>
						@else
							<span class="breadcrumb-item active">
								@if (isset($link['icon']))<i class="{{ $link['icon'] }} mr-1"></i>@endif
								{!! __($link['text']) !!}
							</span>
						@endif
					@else
						<span class="breadcrumb-item active">{!! $link['text'] !!}</span>
					@endif
				@endforeach
			</div>

			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>

		<div class="header-elements d-none">
			<div class="breadcrumb justify-content-center">
				@foreach ($navbarLinks ?? [] as $link)
					<div class="breadcrumb-elements-item {{ isset($link['submenu']) ? 'dropdown' : '' }} p-0">
						<a href="#"
						   class="breadcrumb-elements-item {{ isset($link['submenu']) ? 'dropdown-toggle' : '' }}"
						   data-toggle="{{ isset($link['submenu']) ? 'dropdown' : '' }}"
						>
							@if (isset($link['icon']))
								<i class="{{ $link['icon'] }} mr-2"></i>
							@endif
							{!! $link['text'] !!}
						</a>

						@if (isset($link['submenu']))
							<div class="dropdown-menu dropdown-menu-right">
								@foreach ($link['submenu'] as $subLink)
									<a href="{{ $subLink['url'] }}" class="dropdown-item">
										@if (isset($subLink['icon']))
											<i class="{{ $subLink['icon'] }} mr-2"></i>
										@endif
										{!! $subLink['text'] !!}
									</a>
									@if ($subLink['divider'] ?? false === true)
										<div class="dropdown-divider"></div>
									@endif
								@endforeach
							</div>
						@endif
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
