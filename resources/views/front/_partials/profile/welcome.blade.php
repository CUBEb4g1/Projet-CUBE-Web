@extends('front.profile')

@section('title', 'Mon profil')

@section('right-side')
<div class="profile-content"> <!-- MODAL BLOCK -->
    <h5 class="titular">Salut {{$user->username}}</h5>
    <div class="profile-content first">
        <p>Ice-cream trucks only play music when out of ice-cream. Well played dad. On <a class="profile-content-link" href="#17">@Quora</a></p>
        <p><a class="time-ago scnd-font-color" href="#18">3 minutes ago</a></p>
    </div>
    <div class="profile-content">
        <p>We are in the process of pushing out all of the new CC apps! We will tweet again once they are live <a class="profile-content-link" href="#19">#CreativeCloud</a></p>
        <p><a class="scnd-font-color" href="#20">6 hours ago</a></p>
    </div>
</div>
<div class="profile-content"> <!-- MODAL BLOCK -->
    <h5 class="titular">Salut {{$user->username}}</h5>
    <div class="profile-content first">
        <p>Ice-cream trucks only play music when out of ice-cream. Well played dad. On <a class="profile-content-link" href="#17">@Quora</a></p>
        <p><a class="time-ago scnd-font-color" href="#18">3 minutes ago</a></p>
    </div>
    <div class="profile-content">
        <p>We are in the process of pushing out all of the new CC apps! We will tweet again once they are live <a class="profile-content-link" href="#19">#CreativeCloud</a></p>
        <p><a class="scnd-font-color" href="#20">6 hours ago</a></p>
    </div>
</div>
<div class="profile-content"> <!-- MODAL BLOCK -->
    <h5 class="titular">Salut {{$user->username}}</h5>
    <div class="profile-content first">
        <p>Ice-cream trucks only play music when out of ice-cream. Well played dad. On <a class="profile-content-link" href="#17">@Quora</a></p>
        <p><a class="time-ago scnd-font-color" href="#18">3 minutes ago</a></p>
    </div>
    <div class="profile-content">
        <p>We are in the process of pushing out all of the new CC apps! We will tweet again once they are live <a class="profile-content-link" href="#19">#CreativeCloud</a></p>
        <p><a class="scnd-font-color" href="#20">6 hours ago</a></p>
    </div>
</div>
@endsection
