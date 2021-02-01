<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<div class="banner-home" style="background-image:url(https://phoenixia-prods.com/wp-content/uploads/2020/12/1.jpg);">
    <!-- Row  -->
    <div class="row special-align">
        <div class="col-lg-6 p-0 bg-soft-dark">
            <div class="d-md-flex align-items-center h-100 p-5 text-center justify-content-center">
                <div class="pt-5 pb-5">
                    <img src="{{ asset_cache('media/favicons/favicon.png') }}" height=180px width=180px alt="">
                    <h1 class="font-weight-medium">Hello, bienvenue !</h1>
                    <h5 class="mb-4 text-dark">Explore dès maintenant de nouvelles possibilités</h5>
                    <a target="_blank" class="btn btn-md btn-block btn-outline-special btn-lg border-0" href="/">Suivre le guide</a>
                    </a>
                </div>
            </div>
        </div>
        @include('front._partials.search_box')
    </div>
</div>
