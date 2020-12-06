@if ($field->label !== null)
	@include('_partials.form.label')
@endif

<div class="custom-file">
	<input type="file" @include('_partials.form.attr', ['attr' => $field->input['attr']]) >
	@if (!empty($field->errors))
		@include('_partials.form.error')
	@endif
	<label class="custom-file-label" data-browse="{{ __('Browse') }}"></label>
</div>

@once
	@push('scripts')
		<script>
			$(function () {
				// Afficher les fichiers choisis par l'utilisateur
				$('.custom-file-input').on('change', function (e) {
					var filesNames = '';
					$.each(this.files, function (key, file) {
						filesNames += file.name + ', ';
					});
					$(this).next('.custom-file-label').html(filesNames);
				});
			});
		</script>
	@endpush
@endonce
