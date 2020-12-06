import { __ } from '../../../lang/I18n'

export default () => {
	return {
		id: 'bs-video',
		label: '<i class="fab fa-youtube fa-4x"></i><div>' + __('blocks.video') + '</div>',
		category: __('blocks.essential'),
		content: {
			type: 'bs-video',
		}
	}
}
