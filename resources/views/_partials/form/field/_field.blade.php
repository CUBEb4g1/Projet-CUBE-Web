@if ($field->label !== null)
	@include('_partials.form.label')
@endif

{{ $slot }}

@if (!empty($field->errors))
	@include('_partials.form.error')
@endif
