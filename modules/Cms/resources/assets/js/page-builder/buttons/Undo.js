import { __ } from '../lang/I18n'

export default function () {
	return {
		id: 'undo',
		className: 'btn-toggle-borders',
		label: '<i class="fas fa-reply"></i>',
		command: 'undo',
		attributes: { title: __('editor.undo'), class: 'gjs-pn-btn--combine-r' }
	}
}
