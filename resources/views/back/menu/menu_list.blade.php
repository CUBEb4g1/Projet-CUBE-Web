@extends('back._layouts.app')

@section('title', __('Menus'))

@push('styles')
	<style>
		/* fix pour nestedSortable */
		.content-wrapper {
			overflow: hidden !important;
		}
	</style>
@endpush

@section('content')
	@component('back._cmpts.page_header', [
		'title' => __('Menus'),
		'subtitle' => __('List'),
	])@endcomponent

	<div class="content">
		<div class="d-flex align-items-start flex-column flex-md-row">
			{{-- SIDEBAR --}}
			<div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-left border-0 shadow-0 sidebar-expand-md">
				<div class="sidebar-content">
					<div class="card">
						<div class="card-header bg-transparent header-elements-inline">
							<span class="card-title font-weight-semibold">{{ __('Existing menus') }}</span>
						</div>

						<div class="nav nav-sidebar">
							@if (!$menus->isEmpty())
								@foreach($menus as $menuLeft)
									<li class="nav-item">
										<a href="{{ route('back.menu.list', ['menu' => $menuLeft->id]) }}"
										   class="nav-link border-0 {{ hlrt_has_params(['menu' => $menuLeft->id]) }}"
										>
											<span>{{ $menuLeft->name }}</span>
											<small class="align-self-center ml-auto"><i class="fas fa-pencil mr-0"></i></small>
										</a>
									</li>
								@endforeach
							@else
								<li class="nav-item">
									<span class="nav-link justify-content-center text-muted">
										{{ __('No existing menu') }}…
									</span>
								</li>
							@endif
						</div>

						<div class="card-body">
							<a href="{{ route('back.menu.create') }}" class="btn btn-light btn-block">
								<i class="fa fa-plus fa-fw"></i> {{ __('Add') }}
							</a>
						</div>
					</div>
				</div>
			</div>

			{{-- CONTENT --}}
			<div class="w-100">
				<div class="card">
					@if ($menu !== null)
						<form action="{{ route('back.menu.update', ['menu' => $menu->id]) }}" method="post">
							@csrf
							<div class="card-body">
								<div class="row justify-content-between">
									<div class="col-lg-6">
										<h6 class="card-title"><i class="far fa-stream mr-2"></i> {{ __('Menu structure') }}</h6>

										<div class="nav-menu-sortable">
											<ol id="accordion-control-tree-item" class="js-menu-sortable card-group-control card-group-control-right">
												@foreach ($menu->getTree() as $node)
													@include('back.menu._tree_item', ['node' => $node])
												@endforeach

												@if (empty($menu->getTree()))
													<div id="emptyMenu" class="h6 text-center text-muted my-4">
														{{ __('This menu is empty') }}…
													</div>
												@endif
											</ol>

											@form('hidden', [
												'input' => [
													'name' => 'tree',
													'id' => 'menu-sortable-tree-input'
												],
											])
										</div>

										<button type="button"
												class="btn btn-light btn-sm btn-block mt-4"
												data-toggle="modal"
												data-target="#addNavItemModal">
											<i class="fal fa-plus mr-2"></i> {{ __('Add a link') }}
										</button>
									</div>
									<div class="col-lg-5">
										<h6 class="card-title"><i class="fas fa-pencil-alt mr-2"></i> {{ __('Menu options') }}</h6>

										@include('back.menu._menu_form_inputs')

										<div class="text-center mt-5">
											<a href="{{ route('back.menu.delete', ['menu' => $menu->id]) }}"
											   class="text-danger"
											   onclick="return confirm('{{ __('Delete this menu?') }}')">
												<small><i class="fal fa-trash fa-fw"></i> {{ __('Delete') }}</small>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer bg-white">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-save mr-2"></i> {{ __('Save') }}
								</button>
							</div>
						</form>
					@else
						<div class="card-body">
							@if (!$menus->isEmpty())
								<div class="h6 text-center text-muted my-5">
									<div class="pb-3">{{ __('Choose a menu to edit') }}</div>
									<i class="fal fa-arrow-alt-left fa-2x"></i>
								</div>
							@else
								<div class="h6 text-center text-muted my-4">
									{{ __('Create your first menu to start adding links') }}…
								</div>
								<div class="text-center mb-4">
									<a href="{{ route('back.menu.create') }}" class="btn btn-primary btn-lg">
										<i class="fa fa-plus fa-fw"></i> {{ __('Create a new menu') }}
									</a>
								</div>
							@endif
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>

	@if ($menu !== null)
		<div id="prototypeNavItem" class="d-none">
			@include('back.menu._tree_item', ['isPrototype' => true, 'node' => null])
		</div>

		@component('_cmpts.modal', ['id' => 'addNavItemModal', 'title' => __('Add a link')])
			<form id="createNavItemForm" action="{{ route('back.menu.add_item', ['menu' => $menu->id]) }}" method="post">
				@include('back.menu._item_form_inputs', ['item' => null, 'isPrototype' => false, 'inArray' => false])
			</form>

			@slot('footer')
				<button type="submit" form="createNavItemForm" class="btn btn-primary">
					<i class="fa fa-plus fa-fw"></i> {{ __('Add') }}
				</button>
			@endslot
		@endcomponent
	@endif
@endsection

@push('scripts')
	<script>
		MenuListFormBundle();
	</script>
@endpush
