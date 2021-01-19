@extends('front._layouts.app')

@section('title', __('Contact form'))

@section('content')
    <div class="login-fg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 bg" style="background-image:url({{ asset('/media/front/wave.png') }})">
                    <div class="info">
                        <h1 class="font-weight-medium">Ressources Relationnelles</h1>
                        <h5 class="mb-4 text-dark">Explore dès maintenant de nouvelles possibilités</h5>
                        <div class="img">
                            <img src="{{ asset('media/front/phone.png') }}">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 login">
                    <div class="form-section">
                        <div class="logo clearfix">
                            <a href="/">
                                <img src="{{ asset_cache('media/favicons/favicon.png') }}" alt="Ressources Relationnelles"/>
                            </a>
                        </div>
                        <h1 class="font-weight-medium">{{ __('Contact form') }}</h1>
                        <div class="or-login clearfix"></div>
                        @if(session('emailSent'))
                            <p class="text-center text-success my-5">{{ session('emailSent') }}</p>
                        @else
                            <form method="POST" action="{{ route('contact') }}">
                                @csrf
                                <div class="form-container">
                                    <div class="col-md-5 form-group form-fg">
                                        @form('text', [
                                            'input' => [
                                                'placeholder' => __('Your name'),
                                                'name' => 'name',
                                                'value' => old('name'),
                                                'class' => 'input-text',
                                                'required',
                                            ],
                                        ])
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="col-md-7 form-group form-fg">
                                        @form('text', [
                                            'input' => [
                                                'placeholder' => __('Your email'),
                                                'name' => 'email',
                                                'value' => old('email'),
                                                'class' => 'input-text',
                                                'required',
                                            ],
                                        ])
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="col-md-12 form-group form-fg">
                                        @form('text', [
                                            'input' => [
                                                'placeholder' => __('Mail object'),
                                                'name' => 'subject',
                                                'value' => old('subject'),
                                                'autocomplete' => 'off',
                                                'class' => 'input-text',
                                            ],
                                        ])
                                        <i class="fas fa-outdent"></i>
                                    </div>
                                    <div class="col-md-12 form-group form-fg-special">
                                        @form('textarea', [
                                            'input' => [
                                                'placeholder' => __('Your message'),
                                                'name' => 'message',
                                                'value' => old('message'),
                                                'class' => 'input-text',
                                                'rows' => 10,
                                                'required',
                                            ],
                                        ])
                                        <i class="fas fa-keyboard"></i>
                                    </div>
                                    <div class="col-md-12 form-group mt-2">
                                        <button type="submit" class="btn btn-md btn-block btn-outline-special btn-lg border-0"><i class="fas fa-paper-plane mr-3"></i>{{ __('Send my message') }}</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

