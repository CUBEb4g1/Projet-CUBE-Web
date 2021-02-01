@extends('front.profile')

@section('title', 'Mes favoris')

@section('right-side')
    @foreach($favorites as $favorite)
        {{$favorite->title}}
    @endforeach
@endsection
