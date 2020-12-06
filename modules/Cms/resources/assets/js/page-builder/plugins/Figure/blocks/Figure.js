import { __ } from '../../../lang/I18n'

export default () => {
	return {
		id: 'figure',
		label: '<i class="far fa-image fa-4x"></i><div>' + __('blocks.image') + '</div>',
		category: __('blocks.essential'),
		content: {
			type: 'figure',
		}
	}
}
