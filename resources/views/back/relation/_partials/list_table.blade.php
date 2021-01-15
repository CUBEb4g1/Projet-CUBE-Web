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
				
					<a href="{{ route('back.relation.form', ['relation' => $relation->id]) }}" class="btn btn-sm" data-toggle="tooltip" title="{{ __('Edit') }}">
						<i class="fas fa-pencil"></i>
					</a>
				@component('back._cmpts.more_actions')
					{{-- Supprimer --}}
					@if (!$relation->deleted)
						<a href="{{ route('back.relation.delete', ['relation' => $relation->id]) }}" class="dropdown-item text-danger" data-toggle="tooltip" title="{{ __('Delete') }}">
							<i class="fa fa-times fa-fw"></i>{{ __('Delete') }}
						</a>
					@else
						<a href="{{ route('back.relation.restore', ['relation' => $relation->id]) }}" class="dropdown-item text-danger" data-toggle="tooltip" title="{{ __('Restaurer') }}">
							<i class="fa fa-times fa-fw"></i>{{ __('Restaurer') }}
						</a>
					@endif

				@endcomponent
			</td>
	</tr>
	@endforeach
</tbody>
