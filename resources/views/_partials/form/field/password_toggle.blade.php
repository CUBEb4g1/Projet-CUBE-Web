@if ($field->label !== null)
	@include('_partials.form.label')
@endif

<div class="input-group input-group-password-toggle js-form-field-password-toggle">
	<input type="password" @include('_partials.form.attr', ['attr' => $field->input['attr']])>

	<div class="input-group-append">
		<button class="btn btn-sm btn-dark toggle" type="button" title="{{ __('Display the password') }}"><i class="fa fa-eye"></i></button>
	</div>

	@if (!empty($field->errors))
		@include('_partials.form.error')
	@endif
</div>

@once
	@push('scripts')
	<script>
		$(function () {
			/**
			 * Cacher le mot de passe
			 *
			 * @param $input
			 */
			function toPassword($input) {
				$input.removeClass('show').attr('title', '{{ __('Display the password') }}')
					.find('i').removeClass('fa-eye-slash').addClass('fa-eye')
					.parents(selector).find('input').attr('type', 'password');
			}

			/**
			 * Afficher le mot de passe
			 *
			 * @param $input
			 */
			function toText($input) {
				$input.addClass('show').attr('title', '{{ __('Hide the password') }}')
					.find('i').removeClass('fa-eye').addClass('fa-eye-slash')
					.parents(selector).find('input').attr('type', 'text');
			}

			var selector = '.js-form-field-password-toggle';

			$(selector + ' .toggle').each(function () {
				var $el = $(this);

				// Au click toggle la visibilité du mot de passe
				$el.on('click', function () {
					if ($el.hasClass('show')) {
						toPassword($el);
					} else {
						toText($el);
					}
				});

				// Au submit du formulaire bien repasser le champ en type=password pour éviter que les navigateurs ne retiennent le champ
				$(selector).parents('form').on('submit', function () {
					toPassword($el);
				});
			});
		});
	</script>
	@endpush
@endonce
