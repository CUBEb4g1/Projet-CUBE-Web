@extends('back._layouts.app')

@section('title', __('Categories'))

@section('content')
    @component('back._cmpts.page_header', [
        'title' => __('Categories'),
        'subtitle' => __('List'),
    ])@endcomponent

    <div class="content">
        <div class="mb-3">
            <a href="{{ route('back.category.form') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus"></i> {{ __('Add') }}</a>
        </div>
        <div class="card">
            <table class="table table-striped">
                @include('back.category._partials.list_table', ['categories' => $categories])
            </table>

            @if ($categories->lastPage() > 1)
                <div class="card-body">
                    <nav class="d-flex justify-content-center">
                        {{ $categories->links() }}
                    </nav>
                </div>
            @endif
        </div>
    </div>
@endsection
