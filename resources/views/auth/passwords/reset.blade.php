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
					<form method="POST" action="{{ route('password.update') }}">
						@csrf

						<input type="hidden" name="token" value="{{ $token }}">
						<input type="hidden" name="email" value="{{ request('email') }}">

						<div class="auth-card">
							<div class="auth-card__header">
								<h1 class="auth-card__title">{{ __('Reset Password') }}</h1>
							</div>

							<div class="auth-card__body">
								<div class="form-group">
									@form('password', [
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

								<div class="form-group">
									@form('password', [
										'label' => [
											'text' => __('Confirm Password'),
												'class' => 'auth-card__label',
										],
										'input' => [
											'name' => 'password_confirmation',
												'class' => 'auth-card__input',
											'required',
										],
									])
								</div>

								<button type="submit" class="btn btn-primary btn-block auth-card__btn">
									{{ __('Reset Password') }}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
