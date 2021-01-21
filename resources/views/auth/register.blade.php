@extends('front._layouts.app')

@section('title', __('Register'))

@section('content')
    <div class="login-fg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8 col-lg-7 col-md-12 bg" style="background-image:url({{ asset('/media/front/wave.png') }})">
                    <div class="info">
                        <h1 class="font-weight-medium">Ressources Relationnelles</h1>
                        <h5 class="mb-4 text-dark">Explore dès maintenant de nouvelles possibilités</h5>
                        <div class="img">
                            <img src="{{ asset('media/front/register.png') }}">
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-12 login">
                    <div class="login-section">
                        <div class="logo clearfix">
                            <a href="/">
                                <img src="{{ asset_cache('media/favicons/favicon.png') }}" height=180px width=180px alt="Ressources Relationnelles"/>
                            </a>
                        </div>
                        <h1 class="font-weight-medium">{{ __('Register') }}</h1>
                        <div class="or-login clearfix"></div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-container">
                                <div class="form-group form-fg">
                                    @form('text', [
                                        'input' => [
                                            'placeholder' => "Nom d'utilisateur",
                                            'name' => 'username',
                                            'value' => old('username'),
                                            'class' => 'input-text',
                                            'required',
                                        ],
                                    ])
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="form-group form-fg">
                                    @form('email', [
                                        'input' => [
                                            'placeholder' => 'Adresse mail',
                                            'name' => 'email',
                                            'value' => old('email'),
                                            'class' => 'input-text',
                                            'required',
                                        ],
                                    ])
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="form-group form-fg">
                                    @form('passwordToggle', [
                                        'input' => [
                                            'placeholder' => 'Mot de passe',
                                            'name' => 'password',
                                            'class' => 'input-text',
                                            'required',
                                        ],
                                    ])
                                </div>
                                {{--<div class="form-group">
                                    @form('password', [
                                         'input' => [
                                            'placeholder' => 'Confirmation du mot de passe',
                                            'name' => 'password_confirmation',
                                            'required',
                                        ],
                                    ])
                                </div>--}}
                                <p>En cliquant sur 'S'incrire', je confirme avoir lu et accepté nos <a href="#" class="linkButton"> Termes et conditions d'utilisation.</a></p>
                                <div class="form-group mt-2">
                                    <button type="submit" class="btn btn-md btn-block btn-outline-special btn-lg border-0">{{ __('Register') }}</button>
                                </div>
                            </div>
                        </form>
                        <p>Tu as deja un compte ? <a href="{{ route('login') }}" class="linkButton"> {{ __('Login') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
