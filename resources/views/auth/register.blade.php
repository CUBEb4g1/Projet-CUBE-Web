@extends('front._layouts.app')

@section('title', __('Register'))

@push('styles')
	<link href="{{ mix('css/auth.css') }}" rel="stylesheet">
@endpush

@section('content')
	<div class="auth-container">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-sm-8 col-md-6 col-lg-5 col-xl-4">
					<form method="POST" action="{{ route('register') }}">
						@csrf

						<div class="auth-card">
							<div class="auth-card__header">
								<h1 class="auth-card__title">{{ __('Register') }}</h1>
							</div>

							<div class="auth-card__body">
								<div class="form-group">
									@form('text', [
										'label' => [
											'text' => __('Username'),
											'class' => 'auth-card__label',
										],
										'input' => [
											'name' => 'username',
											'value' => old('username'),
											'class' => 'auth-card__input',
											'required',
										],
									])
								</div>

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
											'required',
										],
									])
								</div>

								<div class="form-group">
									@form('passwordToggle', [
										'label' => [
											'text' => __('Password'),
											'class' => 'auth-card__label',
										],
										'input' => [
											'name' => 'password',
											'class' => 'auth-card__input',
											'required',
										],
									])
								</div>

								{{--<div class="form-group">
									@form('password', [
										'label' => [
											'text' => __('Confirm Password'),
										],
										'input' => [
											'name' => 'password_confirmation',
											'required',
										],
									])
								</div>--}}

								<button type="submit" class="btn btn-primary btn-block auth-card__btn">
									{{ __('Register') }}
								</button>
							</div>

							<div class="auth-card__footer">
								@if (Route::has('register'))
									<a href="{{ route('login') }}" class="btn btn-block auth-card__btn auth-card__btn--grey">
										{{ __('Login') }}
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
