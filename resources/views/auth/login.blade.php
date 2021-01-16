@extends('front._layouts.app')

@section('title', __('Login'))

@section('content')
    <div class="login-fg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8 col-lg-7 col-md-12 bg" style="background-image:url({{ asset('/media/front/wave.png') }})">
                    <div class="info">
                        <h1 class="font-weight-medium">Ressources Relationnelles</h1>
                        <h5 class="mb-4 text-dark">Explore des maintenant de nouvelles possibilites</h5>
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
                                    <a href="#">Mot de passe oublie</a>
                                </div>
                                <div class="form-group mt-2">
                                    <button type="submit" class="btn btn-md btn-block btn-outline-special btn-lg border-0">{{ __('Login') }}</button>
                                </div>
                            </div>
                        </form>
                        <p>Tu n'as pas encore de compte ? <a href="#" class="linkButton"> Inscription</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- OLD LOGIN FORM --}}
    {{--     <div class="auth-container">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-8 col-md-6 col-lg-5 col-xl-4">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="auth-card">
                                <div class="auth-card__header">
                                    <h1 class="auth-card__title">{{ __('Login') }}</h1>
                                </div>
                                <div class="auth-card__body">
                                    <div class="form-group">
                                        @form('email', [
                                            'label' => [
                                                'text' => __('E-Mail Address'),
                                                'class' => 'auth-card__label',
                                            ],
                                            'input' => [
                                                'name' => 'email',
                                                'value' => old('email'),
                                                'class' => 'auth-card__input',
                                            ],
                                        ])
                                    </div>
                                    <div class="form-group">
                                        @form('password', [
                                            'label' => [
                                                'text' => __('Password'),
                                                'class' => 'auth-card__label',
                                            ],
                                            'input' => [
                                                'name' => 'password',
                                                'value' => old('password'),
                                                'class' => 'auth-card__input',
                                            ],
                                        ])
                                    </div>
                                    <div class="form-group">
                                        @form('checkbox', [
                                            'label' => [
                                                'text' => __('Remember Me'),
                                                'class' => 'auth-card__label',
                                            ],
                                            'input' => [
                                                'name' => 'remember',
                                                'checked' => old('remember'),
                                            ],
                                        ])
                                    </div>
                                    <button type="submit" class="btn btn-md btn-block btn-outline-special btn-lg border-0">
                                        {{ __('Login') }}
                                    </button>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link btn-block btn-sm" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                                <div class="auth-card__footer">
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn btn-block auth-card__btn auth-card__btn--grey">
                                            {{ __('Register') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
    {{-- Scripts --}}
    <script>
        function toggleSignup(){
            document.getElementById("login-toggle").style.backgroundColor="#fff";
            document.getElementById("login-toggle").style.color="#222";
            document.getElementById("signup-toggle").style.backgroundColor="#57b846";
            document.getElementById("signup-toggle").style.color="#fff";
            document.getElementById("login-form").style.display="none";
            document.getElementById("signup-form").style.display="block";
        }
        function toggleLogin(){
            document.getElementById("login-toggle").style.backgroundColor="#57B846";
            document.getElementById("login-toggle").style.color="#fff";
            document.getElementById("signup-toggle").style.backgroundColor="#fff";
            document.getElementById("signup-toggle").style.color="#222";
            document.getElementById("signup-form").style.display="none";
            document.getElementById("login-form").style.display="block";
        }
    </script>
@endsection
