@extends('back._layouts.app')

@section('title', __('Pages list'))

@section('content')
	@component('back._cmpts.page_header', [
		'title' => __('Account settings'),
	])@endcomponent

	<div class="content">
		<div class="row justify-content-center">
			<div class="col-lg-9">
				<div class="card">
					<div class="card-header">
						<div class="card-title">
							<h5>{{ __('Parameters') }}</h5>
						</div>
					</div>
					<div class="card-body">
						<form method="post" enctype="multipart/form-data">
							@csrf

							<div class="row">
								<div class="col-xl-8">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												@form('text', [
													'label' => ['text' => __('Username')],
													'input' => [
														'name' => 'username',
														'value' => old('username') ?? $user->username,
														'required'
													],
												])
											</div>
										</div>

										<div class="col-lg-6">
											<div class="form-group">
												@form('email', [
													'label' => ['text' => __('Email')],
													'input' => [
														'name' => 'email',
														'value' => old('email') ?? $user->email,
														'required'
													],
												])
											</div>
										</div>

										<div class="w-100"></div>

										<div class="col-lg-6">
											<div class="form-group">
												@form('text', [
													'label' => ['text' => __('Firstname')],
													'input' => [
														'name' => 'firstname',
														'value' => old('firstname') ?? $user->firstname,
													],
												])
											</div>
										</div>

										<div class="col-lg-6">
											<div class="form-group">
												@form('text', [
													'label' => ['text' => __('Lastname')],
													'input' => [
														'name' => 'lastname',
														'value' => old('lastname') ?? $user->lastname,
													],
												])
											</div>
										</div>

										<div class="w-100"></div>

										<div class="col-lg-6">
											<div class="form-group">
												@form('passwordToggle', [
													'label' => ['text' => __('Change password')],
													'input' => [
														'name' => 'password',
													],
												])
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl text-center">
									<h5>
										<label>{{ __('Profile picture') }}</label>
									</h5>

									@if ($user->avatar !== null)
										<img src="{{ asset_cache(Auth::user()->getAvatar('sm')) }}" class="rounded-circle mb-4" style="object-fit: cover;" width="150" height="150" alt="">
									@endif

									<div class="row justify-content-center">
										<div class="col-xl-9">
											<div class="form-group">
												@form('file', [
													'input' => [
														'name' => 'avatar',
														'value' => old('avatar') ?? $user->avatar,
														'accept' => 'image/*'
													],
												])
											</div>
										</div>
									</div>
								</div>
							</div>

							<button type="submit" class="btn btn-primary">
								<i class="fa fa-save mr-2"></i> {{ __('Save') }}
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
