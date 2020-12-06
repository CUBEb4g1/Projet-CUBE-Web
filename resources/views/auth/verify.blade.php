@extends('front._layouts.app')

@section('title', __('Verify Your Email Address'))

@push('styles')
	<link href="{{ mix('css/auth.css') }}" rel="stylesheet">
@endpush

@section('content')
	<div class="auth-container">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-sm-8 col-md-6 col-lg-5 col-xl-4">
					<div class="auth-card">
						<div class="auth-card__header">
							<h1 class="auth-card__title">{{ __('Verify Your Email Address') }}</h1>
						</div>

						<div class="auth-card__body">
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

									<button type="submit" class="btn btn-primary btn-block auth-card__btn">
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
