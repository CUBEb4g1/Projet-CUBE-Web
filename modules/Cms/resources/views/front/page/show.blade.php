@extends('front._layouts.app')

@section('title', $page->title)

@if (!empty($page->meta_description))
	@push('meta')
		<meta name="description" content="{{ $page->meta_description }}">
	@endpush
@endif

@push('styles')
	<style>
		{!! $page->css !!}
	</style>
@endpush

@section('content')
	@if (!$page->online)
		<div class="alert alert-info text-center mb-0">
			{{ __('This page is a draft, only you can see it.') }}
		</div>
	@endif

	<main class="inner-page inner-page--padded">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-sm-10">
					<h1 class="h-title cms-title">{{ $page->title }}</h1>

					{!! $page->html !!}
				</div>
			</div>
		</div>
	</main>
@endsection
