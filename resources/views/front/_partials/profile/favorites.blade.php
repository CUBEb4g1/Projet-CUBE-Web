<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@extends('.front._layouts.profile')
@section('content')
    <h5 class="titular">Menu modal a integrer</h5>
    <div class="profile-content first">
        <p>Ice-cream trucks only play music when out of ice-cream. Well played dad. On <a class="profile-content-link" href="#17">@Quora</a></p>
        <p><a class="time-ago scnd-font-color" href="#18">3 minutes ago</a></p>
    </div>
    <div class="profile-content">
        <p>We are in the process of pushing out all of the new CC apps! We will tweet again once they are live <a class="profile-content-link" href="#19">#CreativeCloud</a></p>
        <p><a class="scnd-font-color" href="#20">6 hours ago</a></p>
    </div>
@endsection
