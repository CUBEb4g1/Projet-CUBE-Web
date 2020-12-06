import { __ } from '../lang/I18n'

export default () => {
	return {
		id: 'image',
		label: '<i class="far fa-image fa-4x"></i><div>' + __('blocks.image') + '</div>',
		category: __('blocks.essential'),
		content: {
			type: 'image',
			classes: 'cms-image',
			name: __('blocks.image'),
		},
		select: true,
		activate: true,
	}
}
