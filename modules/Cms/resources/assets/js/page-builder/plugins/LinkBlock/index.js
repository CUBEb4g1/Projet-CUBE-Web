import { __ } from "../../lang/I18n";

export default (editor) => {
	/*=======================================================*/
	/*======================== TYPES ========================*/

	editor.DomComponents.addType('link-block', {
		extend: 'link',
		model: {
			defaults: {
				name: __('blocks.link_block'),
				classes: 'cms-link-block',
				droppable: true,
				editable: false,
				stylable: editor.simpleMod ? [
					'float',
					'margin', 'margin-top', 'margin-right', 'margin-bottom', 'margin-left'
				] : true,
			}
		},
	});
}
