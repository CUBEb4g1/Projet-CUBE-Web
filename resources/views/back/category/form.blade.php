@extends('back._layouts.app')

@section('title', __('Category').' - '.($category ? __('Edition') : __('Creation')))

@section('content')
    @component('back._cmpts.page_header', [
        'title' => __('Categories'),
        'subtitle' => $category ? __('Edition') : __('Creation'),
    ])@endcomponent

    <div class="content">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        @if ($category !== null)
                            <span class="h5">{{ $category->label }}</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <form method="post">
                            @csrf
                            <div class="form-group">
                                @form('text', [
                                'label' => ['text' => __('Category')],
                                'input' => ['name' => 'label', 'value' => old('label') ?? ($category ? $category->label : null), 'required'],
                                ])
                            </div>
                            <button type="submit" class="btn btn-primary my-3">
                                <i class="fa fa-save mr-2"></i> {{ __('Save') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
