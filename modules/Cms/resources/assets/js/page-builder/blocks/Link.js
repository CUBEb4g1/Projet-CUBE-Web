import { __ } from '../lang/I18n'

export default () => {
	return {
		id: 'link',
		label: '<i class="far fa-link fa-4x"></i><div>' + __('blocks.link') + '</div>',
		category: __('blocks.essential'),
		content: {
			type: 'link',
			tagName: 'a',
			name: __('blocks.link'),
			content: __('blocks.paragraph_default'),
		},
	}
}
