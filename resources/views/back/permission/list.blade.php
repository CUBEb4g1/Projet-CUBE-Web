@extends('back._layouts.app')

@section('title', __('Permissions'))

@section('content')
	@component('back._cmpts.page_header', [
		'title' => __('Permissions'),
		'subtitle' => __('List'),
	])@endcomponent

	<div class="content">
		<div class="mb-3">
			<a href="{{ route('back.permission.form') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus"></i> {{ __('Add') }}</a>
		</div>

		<div class="card">
			<div class="table-responsive">
				<table class="table table-striped table-vcenter">
					<thead>
						<tr>
							<th width="1">#</th>
							<th>{{ __('Name') }}</th>
							<th>{{ __('Identifier') }}</th>
							<th>{{ __('Assigned to roles') }}</th>
							<th>{{ __('Created at') }}</th>
							<th width="1" class="text-right">{{ __('Actions') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($permissions as $permission)
							<tr>
								<td>
									{!! $permission->id !!}
								</td>
								<td>
									{{ $permission->readable_name }}
								</td>
								<td>
									{{ $permission->name }}
								</td>
								<td>
									@foreach($permission->roles as $role)
										<div>
											<span class="badge badge-primary">- {{ $role->readable_name }}</span>
										</div>
									@endforeach
								</td>
								<td>
									{{ $permission->created_at->format('d/m/Y') }}
								</td>
								<td class="text-right text-nowrap">
									{{-- Modifier --}}
									<a href="{{ route('back.permission.form', ['permission' => $permission->id]) }}" class="btn btn-sm" data-toggle="tooltip" title="{{ __('Edit') }}">
										<i class="fas fa-pencil"></i>
									</a>
									@component('back._cmpts.more_actions')
										{{-- Supprimer --}}
										<a href="{{ route('back.permission.delete', ['permission' => $permission->id]) }}" class="dropdown-item text-danger" data-toggle="tooltip" title="">
											<i class="fa fa-times fa-fw"></i> {{ __('Delete') }}
										</a>
									@endcomponent
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
