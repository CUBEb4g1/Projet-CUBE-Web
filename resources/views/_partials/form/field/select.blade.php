@component('_partials.form.field._field', ['field' => $field])
	<select @include('_partials.form.attr', ['attr' => $field->input['attr']])>
		@if ($field->placeholder !== null)
			<option {{ $field->input['attr']['value'] === null ? 'selected value' : '' }} {{ in_array('required', $field->input['attr'], true) ? 'disabled' : '' }}>{{ $field->placeholder }}</option>
		@endif
		@foreach ($field->selectOptions as $option)
			<option value="{{ $option['value'] }}"
					{{ $field->input['attr']['value'] === $option['value'] ? 'selected' : '' }}
					@include('_partials.form.attr', ['attr' => $option['attr']])>
				{{ $option['text'] }}
			</option>
		@endforeach
	</select>
@endcomponent
