import { __ } from "../lang/I18n";

export default editor => {
	editor.DomComponents.addType('line-break', {
		model: {
			defaults: {
				name: __('blocks.line_break'),
				tagName: 'div',
				droppable: false,
				resizable: {
					// Handlers
					tl: 0, // Top left
					tc: 1, // Top center
					tr: 0, // Top right
					cl: 0, // Center left
					cr: 0, // Center right
					bl: 0, // Bottom left
					bc: 1, // Bottom center
					br: 0 // Bottom right
				},
				style: {
					height: '100px',
				},
			},
		}
	});
}
