<div class="search-box__input-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"><i class="fal fa-search fa-fw"></i></span>
    </div>
    @form('select', [
    'input' => [
    'name' => 'relation',
    'value' => old('relations') ?? $query['relations'] ?? null,
    'class' => 'custom-select js-listen-value',
    ],
    'placeholder' => 'Relation',
    'selectOptions' => $relations->pluck('id', 'label'),
    ])
</div>
