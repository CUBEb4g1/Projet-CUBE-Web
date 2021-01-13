@extends('back._layouts.app')

@section('title', "Statistiques globales")


@section('content')
    @component('back._cmpts.page_header', [
        'title' => "Statistiques",
        'subtitle' => "Global",
    ])@endcomponent

    <div class="content">
        <div class="d-flex flex-row flex-wrap justify-content-around">
            @include('back.statistics._partials.resource_by_category_relation', ['UserTotalCount' => $UserTotalCount, 'UserVerifiedCount' => $UserVerifiedCount, 'UserNotVerifiedCount' => $UserNotVerifiedCount, 'Userchart' => $Userchart])
{{--            @include('back.statistics._partials.ressourcelist', ['ResourceTotalCount' => $ResourceTotalCount, 'VerifiedCount' => $ResourceVerifiedCount, ['ResourcesDeletedCount' => $ResourcesDeletedCount], ['ResourceNotVerifiedCount' => $ResourceNotVerifiedCount],'Resourcechart' => $Resourcechart])--}}

        </div>
    </div>
@endsection
