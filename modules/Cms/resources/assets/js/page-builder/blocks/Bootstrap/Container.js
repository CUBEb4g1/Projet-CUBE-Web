import { __ } from '../../lang/I18n'

export default () => {
	return {
		id: 'container',
		label: '<i class="fa fa-gjs-container fa-4x"></i><div>' + __('blocks.container') + '</div>',
		category: __('blocks.essential'),
		content: {
			type: 'block',
			tagName: 'div',
			classes: 'container cms-block',
			name: __('blocks.container'),
			removable: true,
		}
	}
}
