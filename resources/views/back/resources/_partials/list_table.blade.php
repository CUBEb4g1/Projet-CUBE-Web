<thead>
<tr>
    <th class="td-xs">#</th>
    <th>{{ __('Titre ressource') }}</th>
    <th>{{ __('Utilisateur') }}</th>
    <th>{{ __('Date de création') }}</th>
    <th class="td-xs text-right">{{ __('Actions') }}</th>
</tr>
</thead>
<tbody>
@foreach ($ressourceList as $resources)
    <tr>
        <td>
            {!! $resources->id !!}
        </td>
        <td>
            {{ $resources->title }}
        </td>
        <td>
            {{ $resources->user->username}}
        </td>

        <td>
            {{ $resources->created_at->format('d/m/Y') }}
        </td>
        <td class="text-right text-nowrap">
            {{-- Modifier --}}
            <a href="{{ route('back.resources.form', ['resource' => $resources->id]) }}" class="btn btn-sm"
               data-toggle="tooltip" title="{{ __('Edit') }}">
                <i class="fas fa-pencil"></i>
            </a>
            @component('back._cmpts.more_actions')
                {{-- Supprimer --}}
                <a href="{{ route('back.resources.delete', ['resource' => $resources->id]) }}"
                   class="dropdown-item text-danger" data-toggle="tooltip" title="{{ __('Delete') }}">
                    <i class="far fa-trash-alt fa-fw"></i>{{ __('Delete') }}
                </a>
            @endcomponent
        </td>
    </tr>
@endforeach
</tbody>
