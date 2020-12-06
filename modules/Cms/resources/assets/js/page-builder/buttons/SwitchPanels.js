import { __ } from '../lang/I18n'

const Blocks = function () {
	return {
		id: 'show-blocks',
		label: '<i class="fas fa-th-large"></i>',
		command: 'show-blocks-panel',
		attributes: { title: __('panels.blocks'), id: 'showBlocksBtn', class: 'gjs-pn-btn--lg' },
		active: true,
		togglable: false,
	}
};

const Layers = function () {
	return {
		id: 'show-layers',
		label: '<i class="far fa-stream"></i>',
		command: 'show-layers-panel',
		attributes: { title: __('panels.layers'), id: 'showLayersBtn', class: 'gjs-pn-btn--lg' },
		active: true,
		togglable: false,
	}
};

const Styles = function () {
	return {
		id: 'show-styles',
		label: '<i class="fas fa-paint-brush"></i>',
		attributes: { title: __('panels.styles'), id: 'showStylesBtn', class: 'gjs-pn-btn--lg' },
		command: 'show-styles-panel',
		active: true,
		togglable: false,
	}
};

const Traits = function () {
	return {
		id: 'show-traits',
		label: '<i class="fas fa-cog"></i>',
		attributes: { title: __('panels.settings'), id: 'showTraitsBtn', class: 'gjs-pn-btn--lg' },
		command: 'show-traits-panel',
		active: true,
		togglable: false,
	}
};

export { Blocks, Layers, Styles, Traits };
