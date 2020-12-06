<div class="custom-control custom-checkbox">
	<input type="checkbox" @include('_partials.form.attr', ['attr' => $field->input['attr']])>
	<label @include('_partials.form.attr', ['attr' => $field->label['attr']])>{!! $field->label['text'] !!}</label>
</div>

@if (!empty($field->errors))
	@include('_partials.form.error')
@endif
