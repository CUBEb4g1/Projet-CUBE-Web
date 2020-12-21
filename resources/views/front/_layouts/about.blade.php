<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<section class="our-process" id="about">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-sm-12">
                <h5 class="text-dark">Grace a chacun de vous</h5>
                <h3 class="font-weight-medium text-dark">Explorez de nouveaux horizons !</h3>
                <h5 class="text-dark mb-5">Votre imagination peut vous faire voyager partout</h5>
                <div class="d-flex justify-content-start mb-3">
                    <img src="{{ asset('/media/front/tick.svg') }}" alt="tick" class="mr-3 tick-icon">
                    <p class="mb-0">It is a long established fact that a reader will be distracted</p>
                </div>
                <div class="d-flex justify-content-start mb-3">
                    <img src="{{ asset('/media/front/tick.svg') }}" alt="tick" class="mr-3 tick-icon">
                    <p class="mb-0">There are many variations of passages of Lorem Ipsum</p>
                </div>
                <div class="d-flex justify-content-start mb-3">
                    <img src="{{ asset('/media/front/tick.svg') }}" alt="tick" class="mr-3 tick-icon">
                    <p class="mb-0">Contrary to popular belief, Lorem Ipsum</p>
                </div>
                <div class="d-flex justify-content-start">
                    <img src="{{ asset('/media/front/tick.svg') }}" alt="tick" class="mr-3 tick-icon">
                    <p class="mb-0">Various versions have evolved over the years, sometimes</p>
                </div>
            </div>
            <div class="col-md-5 col-sm-12 text-right">
                <img src="{{ asset('/media/front/idea.svg') }}" alt="idea" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="container stat-icon">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex py-3 my-3 my-lg-0 justify-content-center" >
                            <img src="{{ asset('/media/front/members.svg') }}" alt="" class="mr-3">
                            <div>
                                <h4 class="font-weight-bold mb-0"><span class="scVal">0</span></h4>
                                <h6 class="mb-0">Membres de la communaute</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex py-3 my-3 my-lg-0 justify-content-center">
                            <img src="{{ asset('/media/front/resources.svg') }}" alt="" class="mr-3">
                            <div>
                                <h4 class="font-weight-bold mb-0"><span class="fpVal">0</span></h4>
                                <h6 class="mb-0">Ressources partagees</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex py-3 my-3 my-lg-0 justify-content-center" >
                            <img src="{{ asset('/media/front/actives.svg') }}" alt="" class="mr-3">
                            <div>
                                <h4 class="font-weight-bold mb-0"><span class="tMVal">0</span></h4>
                                <h6 class="mb-0">Membres actifs en ce moment</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex py-3 my-3 my-lg-0 justify-content-center">
                            <img src="{{ asset('/media/front/sessions.svg') }}" alt="" class="mr-3">
                            <div>
                                <h4 class="font-weight-bold mb-0"><span class="bPVal">0</span></h4>
                                <h6 class="mb-0">Sessions de jeu ouvertes</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
