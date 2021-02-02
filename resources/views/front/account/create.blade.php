@extends('front._layouts.app')

@section('title', 'Création de ressource')

@push('styles')
    <link href="{{ mix('css/resources.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="block">
        <form action="{{ route('front.resource_add') }}" method="POST" id="addResource">
            @csrf
            <div class="container my-5 bg-shadow pt-5 pb-5">
                <div class="text-center m-3">
                    <h3 class="h3-green mb-4">Création de votre ressource</h3>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            @form('text', [
                            'input' => [
                            'name' => 'title',
                            'maxlength' => 60,
                            'placeholder' => 'Titre de la ressource  (60 caractères)',
                            'value' => old('title'),
                            'class' => 'form-control',
                            'required'
                                ],
                            ])
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            @form('select', [
                                    'input' => [
                                    'name' => 'category',
                                    'value' => old('categories') ?? null,
                                    'class' => 'custom-select js-listen-value',
                                    'required',
                                    ],
                                    'placeholder' => 'Catégorie',
                                    'selectOptions' => $categories->pluck('id', 'label'),
                            ])
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            @form('select', [
                            'input' => [
                            'name' => 'relation',
                            'value' => old('relations') ?? $query['relations'] ?? null,
                            'class' => 'custom-select js-listen-value',
                            'required',
                            ],
                            'placeholder' => 'Relation',
                            'selectOptions' => $relations->pluck('id', 'label'),
                            ])
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            @form('select', [
                              'input' => [
                              'name' => 'type',
                              'value' => old('types') ?? $query['types'] ?? null,
                              'class' => 'custom-select js-listen-value',
                              'required',
                              ],
                              'placeholder' => 'Types',
                              'selectOptions' => $types->pluck('id', 'label'),
                              ])
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <select class="browser-default custom-select" required name="vType">
                                <option selected value="">Visibilité</option>
                                <option value="3">Publique</option>
                                <option value="1">Privée</option>
                                <option value="2">Partagée</option>
                            </select>
                        </div>
                    </div>
                </div>

                <p class="input-group mx-auto row mb-3 w-100">
                    @form('textarea', [
                        'input' => [
                            'name' => 'content',
                            'placeholder' => 'Créez votre ressource ici !',
                            'class' => 'form-control',
                            'value' => old('resource'),
                        ],
                    ])
                </p>
                <div class="text-center">
                    <button type="submit" form="addResource" class="btn btn-md btn-outline-special border-0">
                        <i class="far fa-plus mr-2"></i> Poster la ressource
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            language: 'fr_FR',
            height: 600,
            statusbar: false,
            plugins: "emoticons hr image link lists charmap table code media",
            toolbar: "formatgroup paragraphgroup insertgroup code | undo redo | cut copy paste | alignleft aligncenter alignright alignjustify",
            toolbar_groups: {
                formatgroup: {
                    icon: 'format',
                    tooltip: 'Formatting',
                    items: 'bold italic underline strikethrough | forecolor backcolor | superscript subscript | removeformat'
                },
                paragraphgroup: {
                    icon: 'paragraph',
                    tooltip: 'Paragraph format',
                    items: 'h1 h2 h3 | bullist numlist | indent outdent'
                },
                insertgroup: {
                    icon: 'plus',
                    tooltip: 'Insert',
                    items: 'link image emoticons charmap hr'
                }
            },
            image_class_list: [
                {title: 'Responsive', value: 'img-fluid'},
            ],
            image_dimensions: false,
            content_style: 'img {max-width: 100%;}',
        });
    </script>
@endpush

