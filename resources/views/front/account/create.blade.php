@extends('front._layouts.app')
@section('content')
    <textarea></textarea>
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

