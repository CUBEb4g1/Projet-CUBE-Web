<div class="search-box__input-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"><i class="fal fa-search fa-fw"></i></span>
    </div>
    @form('select', [
    'input' => [
    'name' => 'category',
    'value' => old('categories') ?? $query['categories'] ?? null,
    'class' => 'custom-select js-listen-value',
    ],
    'placeholder' => 'Catégorie',
    'selectOptions' => $categories->pluck('id', 'label'),
    ])
</div>
