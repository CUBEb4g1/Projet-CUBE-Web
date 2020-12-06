import { __ } from "../../lang/I18n";

export default (editor) => {
	/*=======================================================*/
	/*======================== TYPES ========================*/

	editor.DomComponents.addType('figure', {
		model: {
			defaults: {
				name: __('blocks.figure'),
				tagName: 'figure',
				classes: 'cms-figure',
				droppable: false,
				resizable: {
					keepAutoHeight: true,
					autoHeight: true,
					// Handlers
					tl: 0, // Top left
					tc: 0, // Top center
					tr: 0, // Top right
					cl: 1, // Center left
					cr: 1, // Center right
					bl: 0, // Bottom left
					bc: 0, // Bottom center
					br: 0 // Bottom right
				},
				stylable: editor.simpleMod ? [
					'float',
					'width',
				] : true,
				components: [
					{
						type: 'figure-image',
					}, {
						type: 'figure-caption',
						content: "Description de l'image",
					}
				],
			},
		},
	});

	editor.DomComponents.addType('figure-image', {
		extend: 'image',
		model: {
			defaults: {
				name: __('blocks.image'),
				classes: 'cms-figure__image',
				draggable: false,
				copyable: false,
				removable: false,
				resizable: false,
				selectable: false,
				highlightable: false,
				layerable: false,
			}
		},
	});

	editor.DomComponents.addType('figure-caption', {
		extend: 'text',
		model: {
			defaults: {
				name: __('blocks.figcaption'),
				tagName: 'figcaption',
				classes: 'cms-figure__caption',
				draggable: false,
				copyable: false,
				removable: false,
				highlightable: false,
				layerable: false,
			},
			init () {
				// Ajouter un bouton d'édition à la toolbar
				_addEditBtn(this);
			},
		},
	});

	/**
	 * Ajouter un bouton d'édition à la toolbar
	 *
	 * @param component
	 * @private
	 */
	function _addEditBtn (component) {
		component.get('toolbar').push(
			{
				attributes: {
					class: 'fa fa-pencil'
				},
				command () {
					// Double click
					var event = new MouseEvent('dblclick', {
						'view': window,
						'bubbles': true,
						'cancelable': true
					});
					component.getEl().dispatchEvent(event);
				}
			}
		);
	}

	/*editor.on('component:add', model => {
		if (model.is('figure')) {
			model.get('components').each(child => {
				if (child.is('figure-image')) {
					child.trigger('active');
				}
			});
		}
	});*/
}
