<thead>
<tr>
    <th class="td-xs">#</th>
    <th>{{ __('Category') }}</th>
    <th class="td-xs text-right">{{ __('Actions') }}</th>
</tr>
</thead>
<tbody>
@foreach ($categories as $category)
    <tr>
        <td>
            {!! $category->id !!}
        </td>
        <td>
            {{ $category->label }}
        </td>
        <td>
            {{ $category->active }}
        </td>
        <td class="text-right text-nowrap">
            {{-- Modifier --}}
                <a href="{{ route('back.category.form', ['category' => $category->id]) }}" class="btn btn-sm" data-toggle="tooltip" title="{{ __('Edit') }}">
                    <i class="fas fa-pencil"></i>
                </a>
            @component('back._cmpts.more_actions')
                {{-- Supprimer --}}
                    <a href="{{ route('back.category.delete', ['category' => $category->id]) }}" class="dropdown-item text-danger" data-toggle="tooltip" title="{{ __('Delete') }}">
                        <i class="fas fa-trash-alt"></i>{{ __('Delete') }}
                    </a>
            @endcomponent
        </td>
    </tr>
@endforeach
</tbody>

