@extends('front.profile')

@section('title', 'Mes marques pages')

@section('right-side')
    @foreach($subscriptions as $subscription)
        {{$subscription->id}}
    @endforeach
@endsection
