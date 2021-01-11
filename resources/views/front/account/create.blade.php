@extends('front._layouts.app')
@push('styles')
    <link href="{{ mix('css/resources.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="block">
        <div class="text-center my-3">
            <h3 class="">Création de votre ressource :</h3>
        </div>
        <form action="{{ route('front.resource_add') }}" method="POST" id="addResource">
            @csrf
            <div class="container my-5 bg-shadow pt-5 pb-5">
                <p class="input-group row mb-3 w-100 col-md-10 mx-auto">
                    @form('text', [
                            'input' => [
                            'name' => 'title',
                            'placeholder' => 'Titre de la ressource',
                            'value' => old('title'),
                            'class' => 'form-control',
                            'required'
                        ],
                    ])
                </p>

                <p class="input-group mx-auto row mb-3 w-100 col-md-10">
                    <select class="browser-default custom-select" required name="vType">
                        <option selected value="">Visibilité</option>
                        <option value="2">Publique</option>
                        <option value="3">Privée</option>
                        <option value="4">Partagée</option>
                    </select>
                </p>
                <p class="input-group mx-auto row mb-3 w-100 col-md-10">
                    @form('text', [
                            'input' => [
                                'name' => 'rType',
                                'placeholder' => 'Type de ressource',
                                'class' => "js-search-entity-input form-control",
                                //'data-action' => route(''),
                                'required'
                        ],
                    ])
                </p>

                <p class="input-group mx-auto row mb-3 w-100 col-md-10">
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
                    <button type="submit" form="addResource" class="btn btn-dark btn-padded mt-5 text-center">
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
            plugins: "emoticons hr image link lists charmap table code",
            toolbar: "formatgroup paragraphgroup insertgroup code | undo redo | cut copy paste",
            toolbar_groups: {
                formatgroup: {
                    icon: 'format',
                    tooltip: 'Formatting',
                    items: 'bold italic underline strikethrough | forecolor backcolor | superscript subscript | removeformat'
                },
                paragraphgroup: {
                    icon: 'paragraph',
                    tooltip: 'Paragraph format',
                    items: 'h1 h2 h3 | bullist numlist | alignleft aligncenter alignright | indent outdent'
                },
                insertgroup: {
                    icon: 'plus',
                    tooltip: 'Insert',
                    items: 'link image emoticons charmap hr'
                }
            },
        });
    </script>
@endpush

