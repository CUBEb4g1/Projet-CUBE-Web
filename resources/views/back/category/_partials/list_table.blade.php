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
            <input name="Active" data-id="{{$category->id}}" class="toggle-class"
                   type="checkbox" data-onstyle="success" data-offstyle="danger"
                   data-toggle="toggle" data-on="Active"
                   data-off="InActive" {{ $category->active ? 'checked' : '' }}>
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

@push('scripts')
    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var active = $(this).prop('checked') === true ? 1 : 0;
                var category_id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: '{{route('back.category.active')}}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {'active': active, 'category_id': category_id},
                    success: function(data) {
                        $.jGrowl('Action effectuée !', { position: 'bottom-right', theme: 'bg-info' });
                    }
                })
            })
        })
    </script>
@endpush

