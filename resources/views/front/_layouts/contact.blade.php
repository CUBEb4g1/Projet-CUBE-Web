<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<section class="login-fg" id="contact">
    <div class="container">
        <div class="row mb-5 pb-5">
            <div class="col-sm-5" >
                <img src="{{ asset('/media/front/contact.svg') }}" alt="contact" class="img-fluid">
            </div>
            <div class="col-sm-7" >
                <h3 class="mb-3">Des questions ?</h3>
                <h6 class="mb-5 text-dark">N'hésitez pas à nous en faire part, écrivez-nous !</h6>
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
                                'rows' => 5,
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
</section>
