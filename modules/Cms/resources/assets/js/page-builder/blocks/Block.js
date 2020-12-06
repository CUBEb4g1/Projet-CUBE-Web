import { __ } from '../lang/I18n'

export default () => {
	return {
		id: 'block',
		label: '<i class="far fa-rectangle-landscape fa-4x"></i><div>' + __('blocks.block') + '</div>',
		category: __('blocks.essential'),
		content: {
			type: 'block',
			tagName: 'div',
			classes: 'cms-block',
			name: __('blocks.block'),
		}
	}
}
