@extends('back._layouts.app')

@section('title', "Statistiques globales")

@section('content')
    @component('back._cmpts.page_header', [
        'title' => "Statistiques",
        'subtitle' => "Global",
    ])@endcomponent

    <div class="content">
        <div class="d-flex flex-row">
            <div class="d-flex justify-content-center">
                @include('back.statistics._partials.userstats', ['TotalCount' => $TotalCount, 'VerifiedCount' => $VerifiedCount, 'chart' => $chart])
            </div>
        </div>
    </div>
@endsection
