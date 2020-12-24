<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<section id="home" class="home">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-banner">
                    <div class="bnr-text">
                        <div class="banner-title">
                            <h5 class="text-dark">Vous aussi contribuez a votre bonheur en rejoignant la communaute</h5>
                            <h1 class="font-weight-medium">Ressources Relationnelles</h1>
                        </div>
                        <p class="mb-0 text-dark">Lancez-vous des aujourd'hui ! Il a ete etabli depuis des siecles que<br> le bonheur ne diminue pas lorsqu'il est partage. </p>
                        <a href="{{ route('register') }}" class="btn btn-md btn-block btn-outline-special btn-lg border-0 mt-3">Je m'inscris !</a>
                    </div>
                    <div class="bnr-img">
                        <img src="{{ asset('/media/front/home.svg') }}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
