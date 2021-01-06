{{-- Calling standard front layout --}}
@extends('front._layouts.app')
{{-- Main section --}}
@section('content')
    {{-- Calling at different other layouts / partials --}}
    @include('front._layouts.banner')
    @include('front._layouts.incitation')
    @include('front._layouts.service')
    @include('front._layouts.about')
    @include('front._layouts.team')
    @include('front._layouts.contact')
@endsection
