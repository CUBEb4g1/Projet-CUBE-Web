<div class="col-xl-4"> <!-- LEFT COLUMN -->
    <div class="profile"> <!-- PROFILE CARD -->
        <a class="add-button" href="#"><span class="icon fal fa-plus scnd-font-color"></span></a>
        <div class="profile-picture big-profile-picture clear">
            <a href="{{ route('profile') }}">
                <img width="150px" alt="Default profile image" src="{{ asset('/media/avatars/default.png') }}" >
            </a>
        </div>
        <a href="{{ route('profile') }}">
            <h4 class="user-name">{{$user->username}}</h4>
        </a>
        <div class="profile-description">
            <p class="scnd-font-color">{{$user->bio}}</p>
        </div>
        <ul class="profile-options horizontal-list">
            <li><a class="comments" href="#"><p><span class="icon far fa-comment-alt scnd-font-color"></span>{{$user->comments->count()}}</p></a></li>
            <li><a class="views" href="{{route('profile.subscribes')}}"><p><span class="icon far fa-eye scnd-font-color"></span>{{$user->subscriptions->count()}}</p></a></li>
            <li><a class="likes" href="{{route('profile.favorites')}}"><p><span class="icon far fa-heart scnd-font-color"></span>{{$user->favorites->count()}}</p></a></li>
        </ul>
    </div>
    <div class="menu-box"> <!-- PROFILE MENU -->
        <h5 class="titular">Mon espace</h5>
        <ul class="menu-box-menu">
            <li>
                <a class="menu-box-tab" href="#"><span class="icon far fa-envelope scnd-font-color"></span>Messagerie<div class="menu-box-number">24</div></a>
            </li>
            <li>
                <a class="menu-box-tab" href="{{route('profile.resources')}}"><span class="icon fas fa-photo-video scnd-font-color"></span>Ressources<div class="menu-box-number">{{$user->resources->count()}}</div></a>
            </li>
            <li>
                <a class="menu-box-tab" href="#"><span class="icon fas fa-cog scnd-font-color"></span>Mes paramètres</a>
            </li>
            <li>
                <a class="menu-box-tab" href="#"><span class="icon fas fa-chart-pie scnd-font-color"></span>Statistiques</a>
            </li>
        </ul>
    </div>
    <div class="donut-chart-block"> <!-- STATS BLOCK -->
        <h5 class="titular">Apercu de navigation</h5>
        <div id="userchart"></div>
        <ul class="res-percentages horizontal-list">
            <li>
                <p class="coms res scnd-font-color">Coms.</p>
                <p class="res-percentage">{{$percoms}}<sup>%</sup></p>
            </li>
            <li>
                <p class="vues res scnd-font-color">Vues.</p>
                <p class="res-percentage">{{$persubs}}<sup>%</sup></p>
            </li>
            <li>
                <p class="favs res scnd-font-color">Favs.</p>
                <p class="res-percentage">{{$perfavs}}<sup>%</sup></p>
            </li>
            <li>
                <p class="part res scnd-font-color">Part.</p>
                <p class="res-percentage">{{$perres}}<sup>%</sup></p>
            </li>
        </ul>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('modules/apexcharts/dist/apexcharts.js') }}"></script>
    <script>
        var options =
            {
                chart: {
                    type: 'donut',
                    height: 250
                },
                plotOptions: {
                    bar: {
                        backgroundBarRadius: 2,
                    },
                },
                colors: ([
                    '#0faf96',
                    '#63ff96',
                    '#f7f7f7',
                    '#000000'
                ]),
                stroke: {
                  show: false,
                },
                series:
                {!! $userchart->dataset() !!},
                dataLabels: {
                    enabled: false
                },
                labels: [{!! $userchart->labels() !!}],
                title: {
                    text: "{!! $userchart->title() !!}"
                },
                subtitle: {
                    text: '{!! $userchart->subtitle() !!}',
                    align: '{!! $userchart->subtitlePosition() !!}'
                },
                xaxis: {
                    categories: {!! $userchart->xAxis() !!}
                },
                grid: {!! $userchart->grid() !!},
                legend: {
                    show: false,
                }
            }
        var chart = new ApexCharts(document.querySelector("#userchart"), options);
        chart.render();
    </script>
@endpush
