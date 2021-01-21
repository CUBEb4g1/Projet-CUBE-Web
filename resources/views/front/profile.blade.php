{{-- Calling standard front layout --}}
@extends('front._layouts.app')
{{-- Main section --}}
@section('content')
    {{-- Calling at different other layouts / partials --}}
    @include('front._layouts.profile')
@endsection
