@extends('front._layouts.app')

@section('title', __('Login'))

@section('content')
    <div class="login-fg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8 col-lg-7 col-md-12 bg" style="background-image:url({{ asset('/media/front/wave.png') }})">
                    <div class="info">
                        <h1 class="font-weight-medium">Ressources Relationnelles</h1>
                        <h5 class="mb-4 text-dark">Explore dès maintenant de nouvelles possibilités</h5>
                        <div class="img">
                            <img src="{{ asset('media/front/phone.png') }}">
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-12 login">
                    <div class="login-section">
                        <div class="logo clearfix">
                            <a href="/">
                                <img src="{{ asset_cache('media/favicons/favicon.png') }}" alt="Ressources Relationnelles"/>
                            </a>
                        </div>
                        <h1 class="font-weight-medium">{{ __('Login') }}</h1>
                        <div class="or-login clearfix"></div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-container">
                                <div class="form-group form-fg">
                                    @form('email', [
                                        'input' => [
                                        'placeholder' => 'Adresse mail',
                                        'name' => 'email',
                                        'value' => old('email'),
                                        'class' => 'input-text',
                                        ],
                                    ])
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="form-group form-fg">
                                    @form('password', [
                                        'input' => [
                                    'placeholder' => 'Mot de passe',
                                        'name' => 'password',
                                        'value' => old('password'),
                                        'class' => 'input-text',
                                        ],
                                    ])
                                    <i class="fa fa-unlock-alt"></i>
                                </div>
                                <div class="checkbox clearfix">
                                    <div class="form-check checkbox-fg">
                                        @form('checkbox', [
                                            'label' => [
                                                'text' => __('Remember Me'),
                                                'class' => 'form-check-label',
                                            ],
                                            'input' => [
                                                'name' => 'remember',
                                                'checked' => old('remember'),
                                                'class' => 'form-check-input',
                                            ],
                                        ])
                                    </div>
                                    <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                </div>
                                <div class="form-group mt-2">
                                    <button type="submit" class="btn btn-md btn-block btn-outline-special btn-lg border-0">{{ __('Login') }}</button>
                                </div>
                            </div>
                        </form>
                        <p>Tu n'as pas encore de compte ? <a href="{{ route('register') }}" class="linkButton"> {{ __('Register') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
