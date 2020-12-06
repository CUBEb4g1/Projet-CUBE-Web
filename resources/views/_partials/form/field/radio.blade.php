<div class="custom-control custom-radio">
	<input type="radio" @include('_partials.form.attr', ['attr' => $field->input['attr']])>
	<label @include('_partials.form.attr', ['attr' => $field->label['attr']])>{!! $field->label['text'] !!}</label>
</div>

@if (!empty($field->errors))
	@include('_partials.form.error')
@endif
