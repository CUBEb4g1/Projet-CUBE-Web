@php
	$node        = $node ?? null;
	// Utiliser le template comme un prototype
	$isPrototype = $isPrototype ?? false;
	if ($node !== null) {

		$item = $node['item'];
		$id   = $node['item']->id;
		$text = $node['item']->getSmartText(Request::get('lang'), false) ?? '<small class="text-muted">'.e($node['item']->text).' (pas de traduction)</small>';
	} elseif ($isPrototype) {
		$item = null;
		$id   = '__ID__';
		$text = '__TEXT__';
	}
@endphp
<li id="menuItem_{{ $id }}" class="menu-item">
	<div class="card card--nav-menu-sortable">
		<div class="card-header card-header--nav-menu-sortable">
			<h6 class="card-title">
				<i class="fal fa-grip-lines mr-2 nav-menu-sortable__grab"></i>
				<a data-toggle="collapse" class="collapsed text-default" href="#accordion-control-tree-item-group{{ $id }}">
					{!! $text !!}
				</a>
			</h6>
		</div>

		<div id="accordion-control-tree-item-group{{ $id }}" class="collapse" data-parent="#accordion-control-tree-item">
			<div class="card-body card-body--nav-menu-sortable">
				@include('back.menu._item_form_inputs', ['item' => $item, 'inArray' => true, 'isPrototype' => $isPrototype])
			</div>
			<div class="card-footer py-2">
				<div class="text-right">
					<button type="button"
							class="js-delete-menu-item btn btn-link text-danger p-0"
							data-delete-text="{{ __('Delete this link?') }}">
						<small><i class="fal fa-trash fa-fw"></i> {{ __('Delete') }}</small>
					</button>
				</div>
			</div>
		</div>
	</div>

	@if ($node !== null && !empty($node['children']))
		<ol class="nav-menu-sortable">
			@foreach ($node['children'] as $node)
				@include('back.menu._tree_item', ['node' => $node])
			@endforeach
		</ol>
	@endif
</li>
