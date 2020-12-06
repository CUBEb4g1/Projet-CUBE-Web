@if ($field->label !== null)
	@include('_partials.form.label')
@endif

@php
	$locales         = LaravelLocalization::getLocalesOrder();
	$firstLocaleCode = array_key_first($locales);
	$cssFlagIcons    = ['en' => 'gb'];
@endphp

<div class="js-form-field-multi-lang" data-current-lang="{{ $firstLocaleCode }}">
	@foreach ($locales as $localeCode => $properties)
		<input type="hidden"
			   name="{{ $field->input['options']['inputName'] }}[{{ $localeCode }}]"
			   value="{{ $field->input['options']['translations'][$localeCode] }}"
			   class="__iml-hidden-translation-input"
			   data-lang="{{ $localeCode }}"
		>
	@endforeach

	<div class="input-group __iml-visible-input">
		<input type="text" @include('_partials.form.attr', ['attr' => $field->input['attr']])>

		@if (count($locales) > 1)
			<div class="input-group-append">
				<button type="button" class="d-flex align-items-center btn btn-light dropdown-toggle btn-icon" data-toggle="dropdown">
					<span class="flag-icon flag-icon-{{ $cssFlagIcons[$firstLocaleCode] ?? $firstLocaleCode }} __iml-current-lang-flag"></span>
				</button>

				<div class="dropdown-menu dropdown-menu-right">
					@foreach ($locales as $localeCode => $properties)
						<button type="button"
								class="dropdown-item __iml-lang-btn"
								data-lang="{{ $localeCode }}"
								data-icon="{{ $cssFlagIcons[$localeCode] ?? $localeCode }}">
							<span class="flag-icon flag-icon-{{ $cssFlagIcons[$localeCode] ?? $localeCode }} mr-2"></span> {{ $properties['native'] }}
						</button>
					@endforeach
				</div>
			</div>
		@endif

		@if (!empty($field->errors))
			{{--fix bootstrap pour afficher l'erreur dans un input-group--}}
			<span class="form-control is-invalid d-none"></span>
			@include('_partials.form.error')
		@endif
	</div>
</div>

@once
	@push('scripts')
	<script>
		$(function () {
			var selector = '.js-form-field-multi-lang';

			$(selector).each(function () {
				var $el           = $(this),
					$input        = $el.find('.__iml-visible-input input'),
					$hiddenInputs = $el.find('.__iml-hidden-translation-input'),
					$currLangFlag = $el.find('.__iml-current-lang-flag'),
					$langBtns     = $el.find('.__iml-lang-btn')
				;

				/*
				 * Au choix d'une langue
				 */
				$langBtns.on('click', function () {
					// Le bouton cliqué
					var $clickedLangBtn = $(this),
						// Le drapeau de la langue précédente
						prevFlagIcon    = $langBtns.filter('[data-lang="' + $el.data('current-lang') + '"]').data('icon');

					// Maj le drapeau de la langue en cours d'édition
					$currLangFlag.removeClass('flag-icon-' + prevFlagIcon);
					$currLangFlag.addClass('flag-icon-' + $clickedLangBtn.data('icon'));
					// Maj le contenu de l'input
					$input.val($hiddenInputs.filter('[data-lang="' + $clickedLangBtn.data('lang') + '"]').val());
					// Maj la langue en cours d'édition
					$el.data('current-lang', $clickedLangBtn.data('lang'));
				});

				/*
				 * Au changement de l'input
				 */
				$input.on('keyup paste cut change', function () {
					var $inputToUpdate = $hiddenInputs.filter('[data-lang="' + $el.data('current-lang') + '"]');
					$inputToUpdate.val($(this).val());
				});
			});
		});
	</script>
	@endpush
@endonce
