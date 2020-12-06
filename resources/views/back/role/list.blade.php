@extends('back._layouts.app')

@section('title', __('Roles'))

@section('content')
	@component('back._cmpts.page_header', [
		'title' => __('Roles'),
		'subtitle' => __('List')
	])@endcomponent

	<div class="content">
		<div class="mb-3">
			<a href="{{ route('back.role.form') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus"></i> {{ __('Add') }}</a>
		</div>

		<div class="card">
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th class="td-xs">#</th>
							<th>{{ __('Name') }}</th>
							<th>{{ __('Identifier') }}</th>
							<th>{{ __('Permissions') }}</th>
							<th>{{ __('Created at') }}</th>
							<th class="td-xs text-right">{{ __('Actions') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($roles as $role)
							<tr>
								<td>
									{!! $role->id !!}
								</td>
								<td>
									{{ $role->readable_name }}
								</td>
								<td>
									{{ $role->name }}
								</td>
								<td>
									@foreach($role->permissions as $permission)
										<div>
											<span class="badge">- {{ $permission->readable_name }}</span>
										</div>
									@endforeach
								</td>
								<td>
									{{ $role->created_at->format('d/m/Y') }}
								</td>
								<td class="text-right text-nowrap">
									{{-- Modifier --}}
									<a href="{{ route('back.role.form', ['role' => $role->id]) }}" class="btn btn-sm" data-toggle="tooltip" title="{{ __('Edit') }}">
										<i class="fas fa-pencil"></i>
									</a>
									@component('back._cmpts.more_actions')
										{{-- Supprimer --}}
										<a href="{{ route('back.role.delete', ['role' => $role->id]) }}" class="dropdown-item text-danger" data-toggle="tooltip" title="{{ __('Delete') }}">
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
