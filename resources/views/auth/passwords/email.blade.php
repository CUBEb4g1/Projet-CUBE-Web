@extends('front._layouts.app')

@section('title', __('Reset Password'))

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
                                <img src="{{ asset_cache('media/favicons/favicon.png') }}" height=180px width=180px alt="Ressources Relationnelles"/>
                            </a>
                        </div>
                        <h1 class="font-weight-medium">{{ __('Reset Password') }}</h1>
                        <div class="or-login clearfix"></div>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-container">
                                @if (session('status'))
                                    <div class="text-center text-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @else
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
                                    <div class="form-group mt-2">
                                        <button type="submit" class="btn btn-md btn-block btn-outline-special btn-lg border-0">{{ __('Send Password Reset Link') }}</button>
                                    </div>
                                @endif
                            </div>
                        </form>
                        <p>Ton mot de passe t'es revenu ? <a href="{{ route('login') }}" class="linkButton"> {{ __('Login') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
