@extends('back._layouts.app')

@section('title', __('Ressources'))

@section('content')
    @component('back._cmpts.page_header', [
        'title' => __('Ressources'),
        'subtitle' => __('List'),
    ])@endcomponent

    <div class="content">

        <div class="mb-3 d-flex w-100 flex-wrap">
            <div class="input-group-postpend justify-content-start">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <a class="btn btn-primary" style="background-color: #093467; color: white" href="{{route('back.resources.list')}}">Tous</a>
                    <a class="btn btn-primary" style="background-color: #093467; color: white" href="{{route('back.resources.list.validated')}}">Validées</a>
                    <a class="btn btn-primary" style="background-color: #093467; color: white" href="{{route('back.resources.list.rejected')}}">Rejetées</a>
                    <a class="btn btn-primary" style="background-color: #093467; color: white" href="{{route('back.resources.list.delete')}}">Supprimées</a>
                    <a class="btn btn-primary" style="background-color: #093467; color: white" href="{{route('back.resources.list.pending')}}">En attente</a>
                </div>
            </div>
            <div class="d-flex w-50">
                @include('back._partials.search_table', ['placeholder' => 'Titre de ressource'], ['value' => $search])
            </div>

        </div>

        <div class="card">
            <table class="table table-striped" id="searchable">
                @include('back.resources._partials.list_table', ['resources' => $ressourceList])
            </table>

            @if ($ressourceList->lastPage() > 1)
                <div class="card-body">
                    <nav class="d-flex justify-content-center">
                        {{ $ressourceList->links() }}
                    </nav>
                </div>
            @endif
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            $("#searchable").on("keyup", function () {
                const value = $(this).val().toLowerCase();
                $("table > tbody tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
@endpush
