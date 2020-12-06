@php
	$node          = $node ?? null;
	$dropdownItem  = $dropdownItem ?? false;
	$linkClass     = $linkClass ?? 'nav-link';
	$dropdownClass = $dropdownClass ?? 'dropdown-item';
	$itemClass     = $dropdownItem === true ? $dropdownClass : $linkClass;
@endphp

@if ($node['item']->obfuscate === true && $node['item']->shouldBeObfuscated())
	<span class="{{ $itemClass }} js-obflink {{ $node['item']->data['class'] }}"
		  id="{{ $node['item']->data['id'] }}"
		  data-o="{{ base64_encode($node['item']->leadsToUrl()) }}"
		  data-target="{{ $node['item']->blank ? '_blank' : '_self' }}"
	>
		{{ $node['item']->getSmartText() }}
	</span>
@else
	<a class="{{ $itemClass }} {{ $node['item']->data['class'] }}"
	   id="{{ $node['item']->data['id'] }}"
	   href="{{ $node['item']->leadsToUrl() }}"
	   target="{{ $node['item']->blank ? '_blank' : '_self' }}"
	>
		{{ $node['item']->getSmartText() }}
	</a>
@endif
