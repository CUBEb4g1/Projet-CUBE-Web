@component('_partials.form.field._field', ['field' => $field])
	<textarea @include('_partials.form.attr', ['attr' => $field->input['attr']])>{{ $field->input['text'] }}</textarea>
@endcomponent
