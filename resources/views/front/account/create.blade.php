@extends('front._layouts.app')
@section('content')
    <form action="" method="POST" id="add">
        @csrf
        <div class="container w-100 mx-auto">
            <div class="input-group mb-3 w-25">
                @form('text', [
                    'input' => [
                        'name' => 'title',
                        'placeholder' => 'Titre de la ressource',
                        'value' => old('title'),
                        'class' => ''
                    ],
                ])
            </div>
            @form('textarea', [
                'input' => [
                    'name' => 'resource',
                    'placeholder' => 'Créez votre ressource ici !',
                    'value' => old('resource')
                ],
            ])

            <button type="submit" form="add" class="btn btn-dark btn-padded mt-2">
                <i class="far fa-plus mr-2"></i> Poster la ressource
            </button>
        </div>
    </form>
@endsection
@push('scripts')
    <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            language : 'fr_FR',
            width: 900,
            height: 300,
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

