import { __ } from '../lang/I18n'

export default function () {
	return {
		id: 'save',
		className: 'btn-toggle-borders',
		label: '<i class="fas fa-save fa-fw"></i>',
		command: editor => editor.store(),
		attributes: {
			id: 'saveBtn',
			title: __('editor.save'),
		},
	}
}
