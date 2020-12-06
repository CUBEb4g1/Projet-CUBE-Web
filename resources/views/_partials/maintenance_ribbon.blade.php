@if (app()->isDownForMaintenance() === true)
	<style>
		#maintenance-ribbon {
			position: fixed;
			top: 0;
			right: 0;
			left: 0;
			background: #fcd144;
			padding: 5px;
			text-align: center;
			z-index: 1050;
		}
		#maintenance-ribbon img.logo {
			width: 30px;
			margin-right: 10px;
			border-radius: 50%;
		}
		#maintenance-ribbon span {
			display: inline-block;
			color: #000;
			font-weight: 500;
		}
	</style>

	<div id="maintenance-ribbon" onmouseover="this.remove()">
		<img class="logo" src="{{ asset_cache('media/logos/logo.svg') }}" alt="{{ config('app.name') }} logo" height="50">
		<span>
			{{ __('The application is under maintenance') }}
		</span>
	</div>
@endif
