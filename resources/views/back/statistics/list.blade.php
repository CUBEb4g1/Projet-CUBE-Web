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
        <div class="d-flex flex-row flex-wrap justify-content-center">
            <div class="d-flex justify-content-center mr-5">
                @include('back.statistics._partials.userstats', ['UserTotalCount' => $UserTotalCount, 'UserVerifiedCount' => $UserVerifiedCount, 'UserNotVerifiedCount' => $UserNotVerifiedCount, 'Userchart' => $Userchart])
            </div>

            <div class="d-flex justify-content-center mr-5">
                @include('back.statistics._partials.ressourcelist', ['ResourceTotalCount' => $ResourceTotalCount, 'VerifiedCount' => $ResourceVerifiedCount, ['ResourcesDeletedCount' => $ResourcesDeletedCount], ['ResourceNotVerifiedCount' => $ResourceNotVerifiedCount],'Resourcechart' => $Resourcechart])
            </div>
        </div>
    </div>
@endsection

