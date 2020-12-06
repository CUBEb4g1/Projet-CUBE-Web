@extends('back._layouts.app')

@section('title', __('Page').' - '.($page ? __('Edition') : __('Creation')))

@prepend('styles')
	<link rel="stylesheet" href="{{ mix('modules/cms/css/cms.css') }}">
	<link rel="stylesheet" href="{{ mix('modules/cms/css/page-builder/layout.css') }}">
@endprepend

@section('content')
	@component('back._cmpts.page_header', [
		'title' => __('Pages'),
		'subtitle' => $page ? __('Edition') : __('Creation'),
	])@endcomponent

	<div class="content">
		<div class="card">
			<div class="card-header bg-white header-elements-sm-inline">
				<h6 class="card-title">
					{{ $page ? $page->title : '' }}
				</h6>
				<div class="header-elements">
					@include('_partials.form.lang_btn')

					@if ($page !== null)
						@if (!$page->trashed())
							@if ($page->online === false)
								{{-- Prévisualiser --}}
								<a href="{{ route('page.show', ['id' => $page->id, 'slug' => $page->slug]) }}?preview"
								   class="btn btn-light ml-3"
								   target="_blank">
									<i class="far fa-eye mr-2"></i> {{ __('Preview') }}
								</a>
							@else
								{{-- Voir la page --}}
								<a href="{{ route('page.show', ['id' => $page->id, 'slug' => $page->slug]) }}"
								   class="btn btn-light ml-3"
								   target="_blank">
									<i class="far fa-eye mr-2"></i> {{ __('cms::pages.show_page') }}
								</a>
							@endif
						@endif
					@endif
				</div>
			</div>

			<form method="post" id="pageForm">
				@csrf
				<div class="card-body">

					<div class="row justify-content-between">
						<div class="col-lg-8">
							<div class="form-group row">
								<label class="col-sm-2 col-form-label is-required">{{ __('cms::pages.form.title') }} </label>
								<div class="col-sm-10">
									@form('textTranslatable', [
										'input' => [
											'name' => 'title',
											'value' => old('title') ?? ($page ? $page->getTranslations('title') : null),
											'required',
											'class' => 'js-page-title-input',
										],
									])
									<span class="form-text text-muted">
										{{ __('cms::pages.help_text.title') }}
									</span>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-2 col-form-label is-required">{{ __('cms::pages.form.slug') }} </label>
								<div class="col-sm-10">
									@form('textTranslatable', [
										'input' => [
											'name' => 'slug',
											'value' => old('slug') ?? ($page ? $page->getTranslations('slug') : null),
											'autocomplete' => 'off',
											'data-updated' => isset($page) ? 'true' : 'false',
											'class' => 'js-page-slug-input',
											'required'
										],
									])
									<span class="form-text text-muted">
										{{ __('cms::pages.help_text.slug') }}
									</span>
								</div>
							</div>
						</div>

						<div class="col-lg-2">
							<div class="form-group">
								<div class="custom-control custom-switch custom-control-lg mb-2">
									<input type="checkbox" name="online" id="online" class="custom-control-input" {{ old('online') || (isset($page) && $page->online) ? 'checked' : '' }} value="1">
									<label class="custom-control-label" for="online">{{ __('Published page') }}</label>
								</div>
								<span class="form-text text-muted">
									{{ __('cms::pages.help_text.published') }}
								</span>
							</div>

							@can($DEV)
								<div class="form-group">
									@form('select',
										['label' => ['text' => __('cms::pages.form.id_tag')],
										'input' => [
											'name' => 'id_tag',
											'value' => old('id_tag') ?? ($page ? $page->id_tag : null),
										],
										'selectOptions' => ['-' => null] + array_combine(Modules\Cms\App\Models\Page::ID_TAGS, Modules\Cms\App\Models\Page::ID_TAGS)
									])
									<span class="form-text text-muted">
										{{ __('cms::pages.help_text.id_tag') }}
									</span>
								</div>
							@endcan
						</div>
					</div>

					<fieldset>
						<legend class="text-uppercase font-size-sm font-weight-bold">{{ __('cms::pages.fieldset.page_edition') }}</legend>

						<div class="mb-3">
							<div class="builder">
								<div class="center-container">
									<div class="top-bar top-bar--spaced-groups"></div>

									<div id="gjs" class="center-container__editor"></div>
								</div>

								<div class="right-container">
									<div class="top-bar top-bar--solo-group"></div>
									<div class="right-container__panels">
										<div class="styles-panel"></div>
										<div class="traits-panel"></div>
										<div class="blocks-panel"></div>
									</div>
								</div>
							</div>
							<div class="d-none">
								@form('textarea', [
									'input' => [
										'name' => 'html',
										'value' => old('html') ?? ($page ? $page->html : null),
									],
								])
								@form('textarea', [
									'input' => [
										'name' => 'css',
										'value' => old('css') ?? ($page ? $page->css : null),
									],
								])
								@form('textarea', [
									'input' => [
										'name' => 'gjs_components',
										'value' => old('gjs_components') ?? ($page ? $page->gjs_components : null),
									],
								])
								@form('textarea', [
									'input' => [
										'name' => 'gjs_styles',
										'value' => old('gjs_styles') ?? ($page ? $page->gjs_styles : null),
									],
								])
							</div>
						</div>

						@can('useEditor', Modules\Cms\App\Models\Page::class)
							<div class="text-center">
								@if ($page !== null)
									<a href="{{ route('back.page.page_builder', ['page' => $page->id ?? null]) }}"
									   id="content-editor-btn"
									   class="btn btn-light">
										{{ __('cms::pages.use_content_editor') }}
									</a>
								@else
									<button type="button" class="btn btn-light disabled">
										{{ __('cms::pages.use_content_editor') }}
									</button>
									<div>
										<small class="text-muted">{{ __('cms::pages.save_before_use_content_editor') }}</small>
									</div>
								@endif
							</div>
						@endcan

					</fieldset>

					<fieldset>
						<legend class="text-uppercase font-size-sm font-weight-bold">{{ __('cms::pages.fieldset.seo') }}</legend>

						<div class="row">
							<div class="col-lg-8">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">{{ __('cms::pages.form.meta_description') }} </label>
									<div class="col-sm-10">
										@form('text', [
											'input' => [
												'name' => 'meta_description',
												'value' => old('meta_description') ?? ($page ? $page->meta_description : null),
												'maxlength' => 155,
											],
										])
										<span class="form-text text-muted">
											{{ __('cms::pages.help_text.meta_description') }}
										</span>
									</div>
								</div>
							</div>
						</div>
					</fieldset>
				</div>
				<div class="card-footer bg-white">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-save mr-2"></i> {{ __('Save') }}
					</button>
					@if ($page !== null)
						<button type="submit" id="stay-btn" class="btn btn-sm btn-link" title="{{ __('Save and stay on the same page') }}">
							{{ __('Apply') }}
						</button>
					@endif
					<input type="hidden" name="stay" value="{{ $page === null ? '1': '0' }}">
				</div>
			</form>
		</div>
	</div>
@endsection

@prepend('scripts')
	<script src="{{ mix('modules/cms/js/page-builder/init/light.js') }}"></script>
@endprepend

@push('scripts')
	<script>
		$(function () {
			//=========================
			//=== Editeur drag&drop ===

			var lightPageBuilder = new LightPageBuilder({
				lang: '{{ app()->getLocale() }}',
				urlLoad: '{{ $page ? route('back.page.page_builder.load', ['page' => $page->id]) : '' }}',
				fileUpload: '{{ route('back.page.page_builder.upload') }}',
				getUploads: '{{ route('back.page.page_builder.uploaded_files') }}',
				styles: [
					'{{ mix('css/front/vendor.css') }}',
					'{{ mix('css/front/app.css') }}',
				],
				textEntryOnly: true,
			});

			$('#pageForm').on('submit', function (e) {
				updateHtmlInput();
			});

			//==============================================================
			// === Enregistrer la page avant d'utiliser l'éditeur avancé ===

			$('#content-editor-btn').on('click', function (e) {
				e.preventDefault();

				if (confirm("{!! __('cms::pages.warn_content_editor') !!}")) {
					var action = $(this).parents('form').attr('action') || window.location.href,
						$el    = $(this);

					updateHtmlInput();

					axios.post(action, $(this).parents('form').serialize()
					).then(function () {
						$el.unbind('click');
						$el[0].click();
					});
				}
			});

			//=================
			//=== Functions ===

			/**
			 * Mettre à jour l'input qui contient le html de la page
			 */
			function updateHtmlInput () {
				$('#input_html').val(lightPageBuilder.editor.getHtml());
				$('#input_css').val(lightPageBuilder.editor.getCss());
				$('#input_gjs_components').val(JSON.stringify(lightPageBuilder.editor.getComponents()));
				$('#input_gjs_styles').val(JSON.stringify(lightPageBuilder.editor.getStyle()));
			}

			window.u = updateHtmlInput;

			//==============================================================
			//=== Mettre à jour le champ slug en fonction du champ titre ===

			var $inputTitle     = $('input.js-page-title-input'),
				$inputSlug      = $('input.js-page-slug-input'),
				$langFieldTitle = $inputTitle.parents('.js-form-field-multi-lang'),
				$langFieldSlug  = $inputSlug.parents('.js-form-field-multi-lang');

			slugify.extend({ '\'': '-' });

			// Editer automatiquement le champ slug quand édition du champ title
			$inputTitle.on('keyup past', function () {
				if ($inputSlug.data('updated') !== true) {
					$inputSlug.val(slugify($(this).val()).toLowerCase()).keyup();
				}
			});

			// Formater correctement le slug à l'édition manuelle
			$inputSlug.on('change', function () {
				if ($(this).val() !== '') {
					$(this).val(slugify($(this).val()).toLowerCase()).change();
				} else {
					$(this).val(slugify($inputTitle.val()).toLowerCase()).change();
				}
			});

			// Au clic sur le changement de langue du champ title changer aussi la langue du champ slug
			$langFieldTitle.find('.__iml-lang-btn').on('click', function () {
				var lang     = $(this).data('lang'),
					slugLang = $langFieldSlug.data('current-lang');

				if (lang !== slugLang) {
					$langFieldSlug.find('.__iml-lang-btn[data-lang="' + lang + '"]').click();
				}
			});

			// Au clic sur le changement de langue du champ slug changer aussi la langue du champ title
			$langFieldSlug.find('.__iml-lang-btn').on('click', function () {
				var lang      = $(this).data('lang'),
					titleLang = $langFieldTitle.data('current-lang');

				if (lang !== titleLang) {
					$langFieldTitle.find('.__iml-lang-btn[data-lang="' + lang + '"]').click();
				}
			});

			//=====================================================
			//=== Rester sur le formulaire après enregistrement ===

			$('#stay-btn').on('click', function (e) {
				$('input[name="stay"]').val(1);
			});
		});
	</script>
@endpush
