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
        <p>Grâce à ton espace personnel, tu pourras retrouver les différentes ressources que tu as
            <a class="profile-content-link" href="{{route('profile.favorites')}}">aimé</a>,
            <a class="profile-content-link" href="{{route('profile.subscribes')}}">mis de côté</a>
            ainsi que toutes celles que tu as
            <a class="profile-content-link" href="{{route('profile.resources')}}">posté</a>
            !</br>
            Pour bien commencer dans cette nouvelle experience, l'équipe t'invite à <a class="profile-content-link" href="{{route('front.resourcecreate')}}">créer ta première ressource</a>.
        </p>
    </div>
</div>
<div class="profile-content"> <!-- MODAL BLOCK -->
    <h5 class="titular">Suis tes statistiques d'utilisation depuis ton inscription</h5>
        <div class="profile-content chart">
            <p>A l'aide de ton <a class="profile-content-link" href="#">espace statistique</a>, tu peux maintenant gérer ton temps d'utilisation de la plateforme au gré de tes envies et besoins.</p>
            <div class="donut-chart">
                <div id="portion1" class="shortened"><div class="trunk coms" data-rel="21"></div></div>
                <div id="portion2" class="shortened"><div class="trunk vues" data-rel="39"></div></div>
                <div id="portion3" class="shortened"><div class="trunk favs" data-rel="31"></div></div>
                <div id="portion4" class="shortened"><div class="trunk part" data-rel="9"></div></div>
                <p class="center-date">Janv.<br><span class="scnd-font-color">{{ now()->year }}</span></p>
            </div>
        </div>
</div>
@endsection
