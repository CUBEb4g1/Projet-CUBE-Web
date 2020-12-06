import { __ } from "../../lang/I18n";

export default (editor) => {
	/*=======================================================*/
	/*======================== TYPES ========================*/

	editor.DomComponents.addType('bs-video', {
		model: {
			defaults: {
				name: __('blocks.video_container'),
				tagName: 'div',
				classes: 'embed-responsive embed-responsive-16by9 cms-video',
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
						type: 'bs-video-media',
					}
				],
			},
			init () {
				// Ajouter un bouton d'édition à la toolbar
				_addEditBtn(this);
			},
		},
		view: ({
			events: {
				click: 'handleClick',
				dblclick () {
					_selectChildMediaComponent(this.model);
				}
			}
		}),
	});

	editor.DomComponents.addType('bs-video-media', {
		extend: 'video',
		model: {
			defaults: {
				name: __('blocks.video'),
				classes: 'embed-responsive-item cms-video__media',
				src: 'img/video2.webm',
				draggable: false,
				copyable: false,
				removable: false,
				resizable: false,
				selectable: false,
				highlightable: false,
				layerable: false,
				stylable: editor.simpleMod ? [] : true,
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
		component.get('toolbar').splice(2, 0,
			{
				attributes: {
					class: 'fa fa-pencil'
				},
				command () {
					_selectChildMediaComponent(component);
				}
			}
		);
	}

	/**
	 * Sélectionner le média
	 *
	 * @param videoComponent
	 * @private
	 */
	function _selectChildMediaComponent (videoComponent) {
		videoComponent.get('components').each(child => {
			if (child.is('bs-video-media')) {
				child.set('selectable', true);

				editor.select(child);
				editor.getContainer().closest('.builder').querySelector('#showTraitsBtn').click();

				child.set('selectable', false);
			}
		});
	}
}
