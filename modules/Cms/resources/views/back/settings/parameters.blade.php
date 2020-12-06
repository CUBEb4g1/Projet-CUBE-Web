<h4 class="card-title">Pages</h4>

@form('checkbox', [
	'label' => ['text' => __('cms::settings.layout_editable.title').'<div class="text-muted">'.__('cms::settings.layout_editable.desc').'</div>'],
	'input' => [
		'name' => 'cms_layout_editable',
		'checked' => old('cms_layout_editable') ?? $settings['cms_layout_editable']->value,
	],
])
