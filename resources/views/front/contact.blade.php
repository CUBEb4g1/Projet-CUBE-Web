@extends('front._layouts.app')

@section('title', __('Contact form'))

@push('styles')
	<link href="{{ mix('css/auth.css') }}" rel="stylesheet">
@endpush

@section('content')
	<div class="auth-container">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-8">

					<div class="auth-card">
						<div class="auth-card__header">
							<h1 class="auth-card__title">{{ __('Contact form') }}</h1>
						</div>

						<div class="auth-card__body">
							@if(session('emailSent'))
								<p class="text-center text-success my-5">{{ session('emailSent') }}</p>
							@else
								<form action="{{ route('contact') }}" method="post">
									@csrf

									<div class="row">
										<div class="col-md">
											<div class="form-group">
												@form('text', [
													'label' => [
														'text' => __('Your name'),
														'class' => 'auth-card__label',
													],
													'input' => [
														'name' => 'name',
														'value' => old('name'),
														'class' => 'auth-card__input',
														'required',
													],
												])
											</div>
										</div>
										<div class="col-md">

											<div class="form-group">
												@form('email', [
													'label' => [
														'text' => __('Your email'),
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
										</div>
									</div>

									<div class="form-group">
										@form('text', [
											'label' => [
												'text' => __('Mail object'),
												'class' => 'auth-card__label',
											],
											'input' => [
												'name' => 'subject',
												'value' => old('subject'),
												'autocomplete' => 'off',
												'class' => 'auth-card__input',
												'required',
											],
										])
									</div>

									<div class="form-group">
										@form('textarea', [
											'label' => [
												'text' => __('Your message'),
												'class' => 'auth-card__label',
											],
											'input' => [
												'name' => 'message',
												'value' => old('message'),
												'class' => 'auth-card__input',
												'rows' => 10,
												'required',
											],
										])
									</div>

									<button type="submit" class="btn btn-primary btn-block auth-card__btn">
										<i class="fas fa-paper-plane mr-3"></i> {{ __('Send my message') }}
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

