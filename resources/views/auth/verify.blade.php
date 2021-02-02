@extends('front._layouts.app')

@section('title', __('Verify Your Email Address'))

@section('content')
    <div class="login-fg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8 col-lg-7 col-md-12 bg" style="background-image:url({{ asset('/media/front/wave.png') }})">
                    <div class="info">
                        <h1 class="h1-green font-weight-medium">Ressources Relationnelles</h1>
                        <h5 class="mb-4 text-dark">Explore dès maintenant de nouvelles possibilités</h5>
                        <div class="img">
                            <img src="{{ asset('media/front/mailverif.png') }}">
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
                        <h1 class="font-weight-medium">{{ __('Verify Your Email Address') }}</h1>
                        <div class="or-login clearfix"></div>
                        <div class="form-container">
                            <p class="text-center">
                                {{ __('Before proceeding, please check your email for a verification link.') }}
                            </p>
                            @if (session('resent'))
                                <p class="text-center text-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </p>
                            @else
                                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-md btn-block btn-outline-special btn-lg border-0">
                                        {{ __('Send another email') }}
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
