@component('_partials.form.field._field', ['field' => $field])
	<input type="number" @include('_partials.form.attr', ['attr' => $field->input['attr']])>
@endcomponent
