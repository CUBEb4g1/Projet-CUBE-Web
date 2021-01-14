@extends('back._layouts.app')

@section('title', "Statistiques globales")
@push('styles')
    <link href="{{ mix('css/back/statistics.css') }}" rel="stylesheet">
@endpush



@section('content')
    @component('back._cmpts.page_header', [
        'title' => "Statistiques",
        'subtitle' => "Global",
    ])@endcomponent

    <div class="content">
        <div class="d-flex flex-row flex-wrap justify-content-around">
            @include('back.statistics._partials.userstats', ['UserTotalCount' => $UserTotalCount, 'UserVerifiedCount' => $UserVerifiedCount, 'UserNotVerifiedCount' => $UserNotVerifiedCount, 'Userchart' => $Userchart])
            @include('back.statistics._partials.resourcelist', ['ResourceTotalCount' => $ResourceTotalCount, 'VerifiedCount' => $ResourceVerifiedCount, ['ResourcesDeletedCount' => $ResourcesDeletedCount], ['ResourceNotVerifiedCount' => $ResourceNotVerifiedCount],'Resourcechart' => $Resourcechart])

        </div>
        {!! $UserRegistredByDate->container() !!}
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('modules/apexcharts/dist/apexcharts.js') }}"></script>
    {{ $UserRegistredByDate->script() }}
@endpush

