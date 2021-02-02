@extends('front._layouts.app')

@section('title', 'A propos')

@section('content')
    <div class="aboutus">
        <div class="introduction">
            <!-- Row  -->
            <div class="row special-align fill-80-viewport">
                <div class="col-lg-6 p-0"></div>
                <div class="col-lg-6 p-0 bg-soft-dark">
                    <div class="d-md-flex align-items-center h-100 p-5 text-center justify-content-center">
                        <div class="p-5">
                            <img src="{{ asset_cache('media/favicons/favicon.png') }}" height=180px width=180px alt="">
                            <h1>Le projet Ressources Relationnelles</h1>
                            <h6 class="mb-4 text-dark">Cette plateforme sociale est une simulation d'un projet qui aurait pu être porté par le Ministère des Solidarités et de la Santé. Il a cependant été mis en oeuvre dans le cadre d'une soutenance auprès du CESI de Dijon par la promotion RIL B4.</h6>
                            <a target="_blank" class="px-5 btn btn-md btn-outline-special btn-lg border-0" href="https://dijon.cesi.fr/ecoles-formations/cesi-ecole-superieure-de-lalternance/">Contacter le CESI</a>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="our-process">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col d-none d-md-block ">
                        <img src="{{ asset_cache('media/front/phone-about.png') }}" class="img-fluid"/>
                    </div>
                    <div class="col section-grid">
                        <h3 class="mb-3">L'intégration pour tous !</h3>
                        <div class="rellax">
                            <i class="fas fa-users fa-3x secondary-text"></i>
                            <h4>Une accessibilité maximale</h4>
                            <h6 class="mb-4 text-dark">Conscients de votre mobilité au quotidien, l'équipe a souhaité vous offrir l'opportunité d'expérimenter nos services partout où vous vous trouverez ainsi qu'un environnement graphique adapté.</h6>
                        </div>
                        <div class="rellax">
                            <i class="fas fa-book fa-3x secondary-text"></i>
                            <h4>Un contenu diversifié</h4>
                            <h6 class="mb-4 text-dark">Et comme nous sommes tous différents, il vous est aussi permis d'apprendre, lire, écouter et meme partager les ressources dont vous seul souhaitez bénéficier.</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="our-services">
            <div class="team1">
                <div class="py-5" style="background-color: rgba(0,0,0,.7)">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6 order-sm-2 order-md-1 my-5 ">
                                <h3 class="mb-3">Un code securisé et sans secrets</h3>
                                <h6 class="mb-4 subtitle">Parce que sécuriser vos données dépend aussi de vous, nous vous offrons la possibilité de contribuer à leur protection.</h6>
                                <a class="px-5 btn btn-md btn-outline-special btn-lg border-0" href="https://github.com/CUBEb4g1" target="_blank" role="button">Documentation Git</a>
                            </div>
                            <pre class="col-12 col-md-6 order-1 order-md-2 my-5 py-4 border rounded text-info">
          <span>1</span> <span> //phoenixiaProds.js
          <span>2</span>    const data= {
          <span>3</span>        "purpose": {
          <span>4</span>        "getId" : "#developpers",
          <span>5</span>        "companyName":"phoenixiaProds",
          <span>6</span>        }
          <span>7</span>    }
          <span>8</span>
          <span>9</span>     function codingProds() {
          <span>10</span>        data,
          <span>11</span>         getSecureType
          <span>12</span>   }
          <span>13</span>
          <span>14</span>   function getSecureType()  {
          <span>15</span>        return "codeLaravel&Flutter !"
          <span>16</span>   }     </span>
                    </pre>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
