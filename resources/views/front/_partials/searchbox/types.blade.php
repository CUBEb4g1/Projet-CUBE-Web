<div class="search-box__input-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"><i class="fal fa-search fa-fw"></i></span>
    </div>
    @form('select', [
    'input' => [
    'name' => 'type',
    'value' => old('types') ?? $query['types'] ?? null,
    'class' => 'custom-select js-listen-value',
    ],
    'placeholder' => 'Types',
    'selectOptions' => $types->pluck('id', 'label'),
    ])
</div>
