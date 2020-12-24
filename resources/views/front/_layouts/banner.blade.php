<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<div class="banner-home" style="background-image:url(https://phoenixia-prods.com/wp-content/uploads/2020/12/1.jpg);">
    <!-- Row  -->
    <div class="row special-align">
        <div class="col-lg-6 p-0 bg-soft-dark">
            <div class="d-md-flex align-items-center h-100 p-5 text-center justify-content-center">
                <div class="pt-5 pb-5">
                    <img src="{{ asset_cache('media/favicons/favicon.png') }}" alt="">
                    <h1 class="font-weight-medium">Hello, bienvenue !</h1>
                    <h5 class="mb-4 font-weight-light">Explore des maintenant de nouvelles possibilites</h5>
                    <a target="_blank" class="btn btn-md btn-block btn-outline-special btn-lg border-0" href="/">Suivre le guide</a>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 align-justify-center pr-4 pl-0 contact-form">
            <div class="d-lg-flex align-items-center h-100 p-5 text-center justify-content-center">
                <form class="mt-4">
                    <div class="border p-5 bg-soft-dark">
                        <h3 class="mb-4 font-weight-light">Super formulaire de recherche</h3>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Trouver une ressource">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input class="form-control" type="password" placeholder="Categorie">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input class="form-control" type="password" placeholder="Auteur">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-md btn-block btn-outline-special btn-lg border-0">Rechercher</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
