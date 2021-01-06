<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<section class="our-services" id="services">
    <div class="parallax">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h5>Nous mettons a votre disposition</h5>
                <h3 class="font-weight-medium mb-5">Un eventail illimite de ressources</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-6 text-center text-lg-left">
                <div class="services-box">
                    <img src="{{ asset('/media/front/community.svg') }}" alt="integrated-marketing" >
                    <h6 class="mb-3 mt-4 font-weight-medium">Communaute Riche</h6>
                    <p>Tissez des liens avec nos membres et creez votre propre communaute. </p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 text-center text-lg-left">
                <div class="services-box">
                    <img src="{{ asset('/media/front/games.svg') }}" alt="design-development" >
                    <h6 class="mb-3 mt-4 font-weight-medium">Activites de Groupe</h6>
                    <p>Participez a des jeux, conversations avec vos nouveaux contacts. </p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 text-center text-lg-left">
                <div class="services-box">
                    <img src="{{ asset('/media/front/share.svg') }}" alt="digital-strategy" >
                    <h6 class="mb-3 mt-4 font-weight-medium">Partage de Ressources</h6>
                    <p>Partagez des ressources avec vos amis et le reste de la communaute. </p>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
