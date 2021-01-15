<thead>
	<tr>
		<th class="td-xs">#</th>
		<th>Label</th>
		<th class="td-xs text-right">{{ __('Actions') }}</th>
	</tr>
</thead>
<tbody>

	@foreach ($relations as $relation)
	<tr>
		<td>{{$relation->id}}</td>
		<td>{{$relation->label}}</td>
		<td class="text-right text-nowrap">
				{{-- Modifier --}}
				@can('update', $relation)
					<a href="{{ route('back.relation.form', ['relation' => $relation->id]) }}" class="btn btn-sm" data-toggle="tooltip" title="{{ __('Edit') }}">
						<i class="fas fa-pencil"></i>
					</a>
				@else
					<span class="btn btn-sm disabled" data-toggle="tooltip" title="{{ __('Cannot be edited') }}">
						<i class="fas fa-pencil"></i>
					</span>
				@endcan
				@component('back._cmpts.more_actions')
					{{-- Supprimer --}}
					@can('delete', $relation)
						<a href="{{ route('back.relation.delete', ['relation' => $relation->id]) }}" class="dropdown-item text-danger" data-toggle="tooltip" title="{{ __('Delete') }}">
							<i class="fa fa-times fa-fw"></i>{{ __('Delete') }}
						</a>
					@else
						<span class="dropdown-item text-muted" data-toggle="tooltip" title="{{ __('Cannot be deleted') }}">
							<i class="fa fa-times fa-fw"></i> {{ __('Cannot be deleted') }}
						</span>
					@endcan
				@endcomponent
			</td>
	</tr>
	@endforeach
</tbody>
