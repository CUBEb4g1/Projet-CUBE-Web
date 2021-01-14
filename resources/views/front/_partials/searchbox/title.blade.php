<div class="search-box__input-group input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"><i class="fal fa-search fa-fw"></i></span>
    </div>
    @form('text', [
        'input' => [
            'name' => 'title',
            'placeholder' => "Nom de la ressource",
            'class' => "js-search-entity-input",
        ],
    ])
</div>
