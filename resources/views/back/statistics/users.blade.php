@extends('back._layouts.app')

@section('title', "Statistiques globales")


@section('content')
    @component('back._cmpts.page_header', [
    'title' => "Statistiques",
    'subtitle' => "Global",
    ])@endcomponent
@endsection
