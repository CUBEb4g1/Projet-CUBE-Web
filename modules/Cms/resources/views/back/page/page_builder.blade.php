@extends('back._layouts.empty')

@section('title', __('Page').' - '.($page ? __('Edition') : __('Creation')))

@prepend('styles')
	<link rel="stylesheet" href="{{ mix('modules/cms/css/page-builder/layout.css') }}">
@endprepend

@section('content')
	<div class="builder">
		<div class="left-container">
			<div class="vertical-bar vertical-bar--spaced-groups">
				<a href="{{ route('back.page.form', ['page' => $page->id]) }}"
				   class="exit-btn gjs-pn-btn btn-toggle-borders gjs-four-color"
				   title="{{ __('cms::pages.exit_content_editor') }}">
					<i class="fas animated-exit"></i>
				</a>
			</div>
		</div>

		<div class="center-container">
			<div class="top-bar top-bar--spaced-groups">
				<div></div>
			</div>

			<div id="gjs" class="center-container__editor"></div>
		</div>

		<div class="right-container">
			<div class="top-bar top-bar--solo-group"></div>
			<div class="right-container__panels">
				<div class="styles-panel"></div>
				<div class="traits-panel"></div>
				<div class="layers-panel"></div>
				<div class="blocks-panel"></div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
	<script src="{{ mix('modules/cms/js/page-builder/init/full.js') }}"></script>
	<script>
		new FullPageBuilder({
			lang: '{{ app()->getLocale() }}',
			urlStore: '{{ route('back.page.page_builder.save', ['page' => $page->id]) }}',
			urlLoad: '{{ route('back.page.page_builder.load', ['page' => $page->id]) }}',
			fileUpload: '{{ route('back.page.page_builder.upload') }}',
			getUploads: '{{ route('back.page.page_builder.uploaded_files') }}',
			styles: [
				'{{ mix('css/front/vendor.css') }}',
				'{{ mix('css/front/app.css') }}',
			]
		});
	</script>
@endpush
