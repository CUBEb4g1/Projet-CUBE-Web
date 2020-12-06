@extends('back._layouts.app')

@section('title', __('Role').' - '.($role ? __('Edition') : __('Creation')))

@section('content')
	@component('back._cmpts.page_header', [
		'title' => __('Roles'),
		'subtitle' => $role ? __('Edition') : __('Creation'),
	])@endcomponent

	<div class="content">
		<div class="row justify-content-center">
			<div class="col-lg-9">
				<div class="card">
					<form method="post">
						@csrf

						<div class="card-body">
							<div class="form-group">
								@form('text', [
									'label' => ['text' => __('Name')],
									'input' => ['name' => 'readable_name', 'value' => old('readable_name') ?? ($role ? $role->readable_name : null), 'required'],
								])
							</div>

							<div class="form-group">
								@form('text', [
									'label' => ['text' => __('Unique identifier')],
									'input' => ['name' => 'name', 'value' => old('name') ?? ($role ? $role->name : null), 'required'],
								])
							</div>

							<hr>

							<div class="h5">{{ __('Role Permissions') }}</div>
							@foreach ($permissions as $permission)
								<div class="mb-2">
									@form('checkbox', [
										'label' => ['text' => $permission->readable_name],
										'input' => [
											'id' => 'permission-'.$permission->id,
											'name' => 'permissions[]',
											'value' => $permission->id,
											'checked' => $role ? $role->permissions->contains($permission) : false,
										],
									])
								</div>
							@endforeach
						</div>
						<div class="card-footer bg-white">
							<button type="submit" class="btn btn-primary">
								<i class="fa fa-save mr-2"></i> {{ __('Save') }}
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		@if ($role !== null)
			<div class="h5 mb-1">{{ __('Users with this permission') }}</div>

			<div class="card">
				<table class="table table-striped">
					@include('back.user._partials.list_table', ['users' => $users])
				</table>

				@if ($users->lastPage() > 1)
					<div class="card-body">
						<nav class="d-flex justify-content-center">
							{{ $users->links() }}
						</nav>
					</div>
				@endif

				@if ($users->isEmpty())
					@include('back._partials.nothing_to_display')
				@endif
			</div>
		@endif
	</div>
@endsection
