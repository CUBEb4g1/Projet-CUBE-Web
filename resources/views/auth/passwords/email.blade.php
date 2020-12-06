@extends('front._layouts.app')

@section('title', __('Reset Password'))

@push('styles')
	<link href="{{ mix('css/auth.css') }}" rel="stylesheet">
@endpush

@section('content')
	<div class="auth-container">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-sm-8 col-md-6 col-lg-5 col-xl-4">
					<form method="POST" action="{{ route('password.email') }}">
						@csrf

						<div class="auth-card">
							<div class="auth-card__header">
								<h1 class="auth-card__title">{{ __('Reset Password') }}</h1>
							</div>

							<div class="auth-card__body">
								@if (session('status'))
									<div class="text-center text-success" role="alert">
										{{ session('status') }}
									</div>
								@else
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

									<button type="submit" class="btn btn-primary btn-block auth-card__btn">
										{{ __('Send Password Reset Link') }}
									</button>
								@endif
							</div>

							@if (!session('status'))
								<div class="auth-card__footer">
									<a href="{{ route('login') }}" class="btn btn-block auth-card__btn auth-card__btn--grey">
										{{ __('Login') }}
									</a>
								</div>
							@endif
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
