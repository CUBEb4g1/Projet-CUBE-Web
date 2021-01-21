<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<div class="container profile-gradient">
    <div class="row">
        <div class="col-xl-4"> <!-- LEFT COLUMN -->
            <div class="profile"> <!-- PROFILE CARD -->
                <a class="add-button" href="#"><span class="icon fal fa-plus scnd-font-color"></span></a>
                <div class="profile-picture big-profile-picture clear">
                    <img width="150px" alt="Anne Hathaway picture" src="http://upload.wikimedia.org/wikipedia/commons/e/e1/Anne_Hathaway_Face.jpg" >
                </div>
                <h4 class="user-name">{{$user->username}}</h4>
                <div class="profile-description">
                    <p class="scnd-font-color">{{$user->bio}}</p>
                </div>
                <ul class="profile-options horizontal-list">
                    <li><a class="comments" href="#"><p><span class="icon far fa-comment-alt scnd-font-color"></span>{{$user->comments->count()}}</p></a></li>
                    <li><a class="views" href="#"><p><span class="icon far fa-eye scnd-font-color"></span>{{$user->subscriptions->count()}}</p></a></li>
                    <li><a class="likes" href="#"><p><span class="icon far fa-heart scnd-font-color"></span>{{$user->favorites->count()}}</p></a></li>
                </ul>
            </div>
            <div class="menu-box"> <!-- PROFILE MENU -->
                <h5 class="titular">Mon espace</h5>
                <ul class="menu-box-menu">
                    <li>
                        <a class="menu-box-tab" href="#"><span class="icon far fa-envelope scnd-font-color"></span>Messagerie<div class="menu-box-number">24</div></a>
                    </li>
                    <li>
                        <a class="menu-box-tab" href="#"><span class="icon fas fa-photo-video scnd-font-color"></span>Ressources<div class="menu-box-number">{{$user->resources->count()}}</div></a>
                    </li>
                    <li>
                        <a class="menu-box-tab" href="#"><span class="icon fas fa-cog scnd-font-color"></span>Mes parametres</a>
                    </li>
                    <li>
                        <a class="menu-box-tab" href="#"><span class="icon fas fa-chart-pie scnd-font-color"></span>Statistiques</a>
                    </li>
                </ul>
            </div>
            <div class="donut-chart-block"> <!-- STATS BLOCK -->
                <h5 class="titular">Apercu de navigation</h5>
                <div class="donut-chart">
                    <div id="portion1" class="shortened"><div class="trunk coms" data-rel="21"></div></div>
                    <div id="portion2" class="shortened"><div class="trunk vues" data-rel="39"></div></div>
                    <div id="portion3" class="shortened"><div class="trunk favs" data-rel="31"></div></div>
                    <div id="portion4" class="shortened"><div class="trunk part" data-rel="9"></div></div>
                    <p class="center-date">Janv.<br><span class="scnd-font-color">{{ now()->year }}</span></p>
                </div>
                <ul class="res-percentages horizontal-list">
                    <li>
                        <p class="coms res scnd-font-color">Coms.</p>
                        <p class="res-percentage">21<sup>%</sup></p>
                    </li>
                    <li>
                        <p class="vues res scnd-font-color">Vues.</p>
                        <p class="res-percentage">48<sup>%</sup></p>
                    </li>
                    <li>
                        <p class="favs res scnd-font-color">Favs.</p>
                        <p class="res-percentage">9<sup>%</sup></p>
                    </li>
                    <li>
                        <p class="part res scnd-font-color">Part.</p>
                        <p class="res-percentage">32<sup>%</sup></p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xl-8"> <!-- RIGHT COLUMN -->
            <div class="profile-content"> <!-- MODAL BLOCK -->
                <h5 class="titular">Menu modal a integrer</h5>
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
                <h5 class="titular">Menu modal a integrer</h5>
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
                <h5 class="titular">Menu modal a integrer</h5>
                <div class="profile-content first">
                    <p>Ice-cream trucks only play music when out of ice-cream. Well played dad. On <a class="profile-content-link" href="#17">@Quora</a></p>
                    <p><a class="time-ago scnd-font-color" href="#18">3 minutes ago</a></p>
                </div>
                <div class="profile-content">
                    <p>We are in the process of pushing out all of the new CC apps! We will tweet again once they are live <a class="profile-content-link" href="#19">#CreativeCloud</a></p>
                    <p><a class="scnd-font-color" href="#20">6 hours ago</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
