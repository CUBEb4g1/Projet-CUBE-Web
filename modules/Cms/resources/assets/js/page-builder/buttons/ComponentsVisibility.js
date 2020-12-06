import { __ } from '../lang/I18n'

export default function () {
	return {
		id: 'components-visibility',
		active: true,
		className: 'btn-toggle-borders',
		label: '<i class="far fa-border-style-alt"></i>',
		command: 'sw-visibility', // Built-in command,
		context: 'sw-visibility',
		attributes: { title: __('editor.show_borders') },
	}
}
