@php
	$cssFlagIcons = ['en' => 'gb'];
@endphp

@if (count(LaravelLocalization::getSupportedLocales()) > 1)
	<div class="input-group d-inline-block w-auto">
		<div class="input-group-append">
			<button type="button" class="d-flex align-items-center btn btn-light dropdown-toggle btn-icon" data-toggle="dropdown">
				<i class="fal fa-language fa-lg mr-2"></i> {{ __('Language') }}
			</button>

			<div class="dropdown-menu dropdown-menu-right">
				@foreach (LaravelLocalization::getLocalesOrder() as $localeCode => $properties)
					<button type="button"
							class="dropdown-item js-form-toggle-lang-btn"
							data-lang="{{ $localeCode }}">
						<span class="flag-icon flag-icon-{{ $cssFlagIcons[$localeCode] ?? $localeCode }} mr-2"></span> {{ $properties['native'] }}
					</button>
				@endforeach
			</div>
		</div>
	</div>
@endif

@once
	@push('scripts')
	<script>
		$(function () {
			$('.js-form-toggle-lang-btn').on('click', function () {
				$('.__iml-lang-btn[data-lang="' + $(this).data('lang') + '"]').click();
			});
		});
	</script>
	@endpush
@endonce
