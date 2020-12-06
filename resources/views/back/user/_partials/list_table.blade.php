<thead>
	<tr>
		<th class="td-xs">#</th>
		<th>{{ __('Username') }}</th>
		<th>{{ __('E-Mail Address') }}</th>
		<th>{{ __('Name') }}</th>
		<th>{{ __('Roles') }} & {{ __('Permissions') }}</th>
		<th>{{ __('Registered on') }}</th>
		<th class="td-xs text-right">{{ __('Actions') }}</th>
	</tr>
</thead>
<tbody>
	@foreach ($users as $user)
		<tr>
			<td>
				{!! $user->id !!}
			</td>
			<td>
				{{ $user->username }}
			</td>
			<td>
				{{ $user->email }}
			</td>
			<td>
				{{ !empty($user->getFullName()) ? $user->getFullName() : '-' }}
			</td>
			<td>
				@foreach ($user->roles as $role)
					<span class="badge badge-primary">{{ $role->readable_name }}</span>
				@endforeach
				@foreach ($user->getDirectPermissions() as $permission)
					<div>
						<span class="badge">- {{ $permission->readable_name }}</span>
					</div>
				@endforeach
			</td>
			<td>
				{{ $user->created_at->format('d/m/Y') }}
			</td>
			<td class="text-right text-nowrap">
				{{-- Se connecter au compte --}}
				@if (Auth::id() !== $user->id)
					@can('switchAuth', $user)
						<form action="{{ route('auth.switch') }}" method="post" class="d-inline-block">
							@csrf
							<input type="hidden" name="id" value="{!! $user->id !!}">
							<button class="btn btn-light btn-sm" data-toggle="tooltip" title="{{ __('Login with this account') }}">
								<small>{{ __('Login to the account') }}</small>
							</button>
						</form>
					@endcan
				@endif
				{{-- Modifier --}}
				@can('update', $user)
					<a href="{{ route('back.user.form', ['user' => $user->id]) }}" class="btn btn-sm" data-toggle="tooltip" title="{{ __('Edit') }}">
						<i class="fas fa-pencil"></i>
					</a>
				@else
					<span class="btn btn-sm disabled" data-toggle="tooltip" title="{{ __('Cannot be edited') }}">
						<i class="fas fa-pencil"></i>
					</span>
				@endcan
				@component('back._cmpts.more_actions')
					{{-- Supprimer --}}
					@can('delete', $user)
						<a href="{{ route('back.user.delete', ['user' => $user->id]) }}" class="dropdown-item text-danger" data-toggle="tooltip" title="{{ __('Delete') }}">
							<i class="fa fa-user-times fa-fw"></i>{{ __('Delete') }}
						</a>
					@else
						<span class="dropdown-item text-muted" data-toggle="tooltip" title="{{ __('Cannot be deleted') }}">
							<i class="fa fa-user-times fa-fw"></i> {{ __('Cannot be deleted') }}
						</span>
					@endcan
				@endcomponent
			</td>
		</tr>
	@endforeach
</tbody>
