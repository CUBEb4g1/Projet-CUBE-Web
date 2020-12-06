<div class="form-group">
	@form('select', [
		'label' => ['text' => __('Location')],
		'input' => [
			'name' => 'location',
			'value' => old('location') ?? (isset($menu) ? $menu->location : null),
			'required'
		],
		'selectOptions' => $locations,
		'placeholder' => '-',
	])
</div>

<div class="form-group">
	@form('text', [
		'label' => ['text' => __('Name')],
		'input' => ['name' => 'name', 'value' => old('name') ?? (isset($menu) ? $menu->name : null), 'required'],
	])
</div>

@push('scripts')
	<script>
		//====================================================================
		//=== Mettre à jour le champ name en fonction du champ emplacement ===

		var $location = $('#input_location');
		var $name     = $('#input_name');
		var value     = null;
		var prevValue = $name.val();

		$location.on('change', function () {
			value = $location.children('option').filter(':selected').text().trim();

			if ($name.val() === '' || $name.val() === prevValue) {
				$name.val(value);
			}

			prevValue = value;
		});
	</script>
@endpush
