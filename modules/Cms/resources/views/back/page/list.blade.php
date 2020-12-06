@extends('back._layouts.app')

@section('title', __('Pages list'))

@section('content')
	@component('back._cmpts.page_header', [
		'title' => __('Pages'),
		'subtitle' => __('List'),
	])@endcomponent

	<div class="content">
		<div class="mb-3">
			<a href="{{ route('back.page.form') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus"></i> {{ __('Add') }}</a>
		</div>

		<div class="card">
			<div class="card-header">
				<div class="btn-group">
					<a href="{{ route('back.page.list') }}" class="btn btn-sm {{ !Request::has('cat') ? 'btn-secondary' : 'btn-light' }}">
						{{ __('All') }}
					</a>

					<a href="{{ route('back.page.list', ['cat' => 'draft']) }}" class="btn btn-sm {{ Request::input('cat') === 'draft' ? 'btn-secondary' : 'btn-light' }}">
						<i class="fal fa-fw fa-file-edit"></i> {{ __('Drafts') }}
					</a>

					<a href="{{ route('back.page.list', ['cat' => 'trashed']) }}" class="btn btn-sm {{ Request::input('cat') === 'trashed' ? 'btn-secondary' : 'btn-light' }}">
						<i class="fal fa-fw fa-trash-alt"></i> {{ __('Trash') }}
					</a>
				</div>
			</div>

			<div class="ztable-responsive">
				<table class="table table-striped table-vcenter">
					<thead>
						<tr>
							<th class="td-xs">#</th>
							<th>{{ __('Title') }}</th>
							<th>{{ __('Slug') }}</th>
							<th class="text-center">{{ __('Published') }}</th>
							<th class="td-xs text-right">{{ __('Actions') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($pages as $page)
							<tr>
								<td>
									{!! $page->id !!}
								</td>
								<td>
									<a href="{{ route('back.page.form', ['page' => $page->id]) }}" class="text-dark">
										{{ $page->title }}
									</a>
								</td>
								<td>
									<code>{{ $page->slug }}</code>
								</td>
								<td class="text-center">
									@if ($page->online === true)
										<div class="badge badge-success">oui</div>
									@else
										<div class="badge badge-danger">non</div>
									@endif
								</td>
								<td class="text-right text-nowrap">
									{{-- Modifier --}}
									<a href="{{ route('back.page.form', ['page' => $page->id, 'cat' => request('cat')]) }}" class="btn btn-sm" data-toggle="tooltip" title="{{ __('Edit') }}"><i class="fas fa-pencil"></i></a>

									@component('back._cmpts.more_actions')
										@if (!$page->trashed())
											@if ($page->online === false)
												{{-- Prévisualiser --}}
												<a href="{{ route('page.show', ['id' => $page->id, 'slug' => $page->slug]) }}?preview" class="dropdown-item" target="_blank"><i class="far fa-eye fa-fw"></i> {{ __('Preview') }}
												</a>
											@else
												{{-- Voir la page --}}
												<a href="{{ route('page.show', ['id' => $page->id, 'slug' => $page->slug]) }}" class="dropdown-item" target="_blank"><i class="far fa-eye fa-fw"></i> {{ __('cms::pages.show_page') }}
												</a>
											@endif

											<div class="dropdown-divider"></div>
										@endif
										@if (Request::input('cat') === 'trashed')
											{{-- Restaurer de la corbeille --}}
											<a href="{{ route('back.page.restore', ['page' => $page->id]) }}" class="dropdown-item">
												<i class="fas fa-trash-restore fa-fw"></i> {{ __('Restore') }}
											</a>
											{{-- Supprimer --}}
											<a href="{{ route('back.page.delete', ['page' => $page->id]) }}" class="dropdown-item text-danger" onclick="return confirm('{{ __('This action is irreversible. Are you sure you want to continue?') }}');">
												<i class="far fa-times fa-fw"></i> {{ __('Delete') }}
											</a>
										@else
											{{-- Envoyer à la corbeille --}}
											<a href="{{ route('back.page.trash', ['page' => $page->id]) }}" class="dropdown-item">
												<i class="fas fa-trash fa-fw"></i> {{ __('Send to trash') }}
											</a>
										@endif
									@endcomponent
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>

				@if ($pages->isEmpty())
					@include('back._partials.nothing_to_display')
				@endif
			</div>
		</div>
	</div>
@endsection
