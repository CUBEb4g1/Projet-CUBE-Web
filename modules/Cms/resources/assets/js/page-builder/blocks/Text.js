import { __ } from '../lang/I18n'

export default () => {
	return {
		id: 'text',
		label: '<i class="far fa-text fa-4x"></i><div>' + __('blocks.paragraph') + '</div>',
		category: __('blocks.essential'),
		content: {
			type: 'text',
			tagName: 'div',
			classes: 'cms-block',
			name: __('blocks.paragraph'),
			content: __('blocks.paragraph_default'),
			droppable: false,
			style: {
				padding: '10px',
				'margin-bottom': '25px',
			},
			activeOnRender: 1,
		},
	}
}
