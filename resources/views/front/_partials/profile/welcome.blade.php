@extends('front.profile')

@section('title', 'Mon profil')

@section('right-side')
<div class="profile-content"> <!-- MODAL BLOCK -->
    <h5 class="titular">Salut {{$user->username}} !</h5>
    <div class="profile-content">
        <p>L'équipe des Ressources Relationnelles te souhaite la bienvenue dans ton espace personnel. Tu peux dès à present choisir tes <a class="profile-content-link" href="#">paramètres de profil</a>.</p>
    </div>
    <div class="profile-content first">
        <p><a href="https://github.com/CUBEb4g1/Projet-CUBE-Web" target="_blank">Un guide complet t'es mis à disposition afin de t'accompagner dans tes premiers pas avec ton nouveau compagnon social. Si tu te sens déjà pret à partir à l'aventure, descends lire les blocs suivants !</a></p>
    </div>
</div>
<div class="profile-content"> <!-- MODAL BLOCK -->
    <h5 class="titular">Un espace dédié sans publicités</h5>
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
