import { __ } from '../lang/I18n'

export default function () {
	return {
		id: 'edit-code',
		className: 'btn-toggle-borders',
		label: '<i class="far fa-code"></i>',
		command: 'edit-code',
		attributes: { title: __('editor.edit_code') },
		togglable: false,
	}
}
