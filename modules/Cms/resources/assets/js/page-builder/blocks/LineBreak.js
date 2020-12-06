import { __ } from '../lang/I18n'

export default () => {
	return {
		id: 'line-break',
		label: '<i class="far fa-rectangle-wide fa-4x"></i><div>' + __('blocks.line_break') + '</div>',
		category: __('blocks.essential'),
		content: {
			type: 'line-break',
			classes: 'cms-line-break',
		},
	}
}
