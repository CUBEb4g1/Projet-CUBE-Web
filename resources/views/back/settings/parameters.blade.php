@extends('back._layouts.app')

@section('title', __('Parameters'))

@section('content')
	@component('back._cmpts.page_header', [
		'title' => __('Parameters'),
	])@endcomponent

	<div class="content">
		<div class="row justify-content-center">
			<div class="col-lg-9">
				<div class="card">
					<div class="card-body">
						<form method="post">
							@csrf

							<h4 class="card-title">Utilisateurs</h4>

							<div class="form-group">
								@form('checkbox', [
									'label' => ['text' => __('settings.users_register.title').'<div class="text-muted">'.__('settings.users_register.desc').'</div>'],
									'input' => [
										'name' => 'users_register',
										'checked' => old('users_register') ?? $settings['users_register']->value,
									],
								])
							</div>

							<hr>

							@foreach ($modules as $name => $module)
								@if ($module->isEnabled())
									@includeIf($name.'::back.settings.parameters')
									@if (!$loop->last)
										<hr>
									@endif
								@endif
							@endforeach

							<div class="mt-3">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-save mr-2"></i> {{ __('Save') }}
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
