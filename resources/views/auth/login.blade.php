@extends('front._layouts.app')

@section('title', __('Login'))

@push('styles')
	<link href="{{ mix('css/auth.css') }}" rel="stylesheet">
@endpush

@section('content')
	<div class="auth-container">
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

								<button type="submit" class="btn btn-primary btn-block auth-card__btn">
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
	</div>
@endsection
