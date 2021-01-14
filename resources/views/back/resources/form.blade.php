@extends('back._layouts.app')

@section('title', __('Ressource').' - '.($resource ? __('Edition') : __('Creation')))

@section('content')
    @component('back._cmpts.page_header', [
        'title' => __('Ressource'),
        'subtitle' => $resource ? __('Edition') : __('Creation'),
    ])@endcomponent

    <div class="content">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        @if ($resource !== null)
                            <span
                                class="h5">Titre de la ressource : {{ $resource->title ?? 'ID de la ressource :' . $resource->id}}</span>
                        @endif
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="mb-2">
                                <span>Auteur : {{$resource->user->getAdministrativeFullName() ?? $resource->user->username}}</span>
                            </div>

                            <div class="mb-2">
                                        <span>Visibilité :
                                            @switch ($resource->visibility)
                                                @case(1)
                                                Privée
                                                @break
                                                @case(2)
                                                Partagée
                                                @break
                                                @case(3)
                                                Publique
                                                @break
                                            @endswitch
                                        </span>
                            </div>
                        </div>
                        @csrf

                        <div class="card">
                            <div class="card-header m-0 pb-0">
                                Titre de la ressource :
                            </div>
                            <hr>
                            <div class="card-body">
                                <h5 class="card-title">{{ $resource->title }}</h5>
                            </div>
                        </div>

                        <div class="card p-2">
                            <div class="card-header">
                                Contenu de la ressource :
                            </div>
                            <hr>
                            <div class="card-body overflow-auto">
                                {!! $resource->content !!}
                            </div>
                        </div>

                        @if (is_null($resource->validated))
                            <a type="submit" href="{{route('back.resources.validate', ['resource' => $resource->id])}}"
                               class="btn btn-primary my-3" id="accept">
                                <i class="fa fa-save mr-2"></i> {{ __('Accepter la ressource') }}
                            </a>
                            <a type="submit" href="{{route('back.resources.refuse', ['resource' => $resource->id])}}"
                               class="btn btn-danger my-3" id="reject">
                                <i class="fa fa-times mr-2"></i> {{ __('Rejeter la ressource') }}
                            </a>
                        @elseif (($resource->deleted == 1) || ($resource->validated == 0))
                            <a type="submit" href="{{route('back.resources.restore', ['resource' => $resource->id])}}"
                               class="btn btn-danger my-3" id="reject">
                                <i class="fa fa-times mr-2"></i> {{ __('Restaurer la ressource') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
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
