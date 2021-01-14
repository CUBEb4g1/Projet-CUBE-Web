@extends('back._layouts.app')

@section('title', "Statistiques globales")


@section('content')
    @component('back._cmpts.page_header', [
        'title' => "Statistiques",
        'subtitle' => "Global",
    ])@endcomponent

    <div class="content">
        <div class="d-flex flex-row flex-wrap align-content-center h-100 justify-content-around">
               <span>Aucunes données disponible pour le moment. Veuillez contacter l'administrateur</span>
        </div>
    </div>
@endsection
