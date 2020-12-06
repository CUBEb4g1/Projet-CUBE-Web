import { __ } from '../lang/I18n'

export default () => {
	return {
		id: 'video',
		label: '<i class="fab fa-youtube fa-4x"></i><div>' + __('blocks.video') + '</div>',
		category: __('blocks.essential'),
		content: {
			tagName: 'div',
			classes: 'embed-responsive embed-responsive-16by9',
			components: [{
				type: 'video',
				classes: 'embed-responsive-item',
				src: 'img/video2.webm',
			}]
		},
	}
}
