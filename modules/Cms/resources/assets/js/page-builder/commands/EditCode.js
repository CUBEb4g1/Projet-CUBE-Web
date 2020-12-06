import { __ } from '../lang/I18n'
import { setModalClass } from '../modal/ModalHelpers'

export default function () {
	return [{
		id: 'edit-code',

		run: (editor, sender) => {
			const modal            = editor.Modal,
				  container        = document.createElement('div'),
				  htmlCodeViewer   = editor.CodeManager.getViewer('CodeMirror').clone(),
				  cssCodeViewer    = editor.CodeManager.getViewer('CodeMirror').clone(),
				  codeMirrorConfig = {
					  readOnly: false,
					  autoBeautify: false,
					  autoCloseTags: true,
					  autoCloseBrackets: true,
					  lineWrapping: true,
					  styleActiveLine: true,
					  smartIndent: true,
					  indentUnit: 4,
					  indentWithTabs: true
				  };
			let btnEdit            = null,
				htmlEditor         = null,
				cssEditor          = null;

			_initEditors();
			_generateSaveBtn();
			_generateModal();

			function _initEditors () {
				htmlCodeViewer.set({ codeName: 'htmlmixed', ...codeMirrorConfig });
				cssCodeViewer.set({ codeName: 'css', ...codeMirrorConfig });

				htmlEditor = htmlCodeViewer.editor;
				cssEditor  = cssCodeViewer.editor;
			}

			function _generateSaveBtn () {
				if (btnEdit === null) {
					const pfx = editor.getConfig().stylePrefix;

					btnEdit           = document.createElement('button');
					btnEdit.innerHTML = __('validate');
					btnEdit.className = pfx + 'btn-prim ' + pfx + 'btn-import' + ' modal-code-editors__save-btn';

					btnEdit.onclick = function () {
						const html = htmlCodeViewer.editor.getValue();
						const css  = cssCodeViewer.editor.getValue();

						editor.DomComponents.getWrapper().set('content', '');
						editor.setComponents(html.trim());
						editor.setStyle(css);

						modal.close();
					};
				}
			}

			function _generateModal () {
				modal.setTitle(__('editor.edit_code'));

				setModalClass(modal, 'lg');
				setModalClass(modal, 'code-editor');

				if (!htmlEditor && !cssEditor) {
					const editorsContainer = document.createElement('div');
					editorsContainer.classList.add('modal-code-editors');

					const txtDiv = document.createElement('div'),
						  cssDiv = document.createElement('div');
					txtDiv.classList.add('modal-code-editors__editor');
					cssDiv.classList.add('modal-code-editors__editor');

					editorsContainer.appendChild(txtDiv);
					editorsContainer.appendChild(cssDiv);

					const txtArea = document.createElement('textarea'),
						  cssArea = document.createElement('textarea');

					txtDiv.appendChild(txtArea);
					cssDiv.appendChild(cssArea);

					container.appendChild(editorsContainer);
					container.appendChild(editorsContainer);
					container.appendChild(btnEdit);

					htmlCodeViewer.init(txtArea);
					cssCodeViewer.init(cssArea);

					htmlEditor = htmlCodeViewer.editor;
					cssEditor  = cssCodeViewer.editor;
				}

				modal.setContent('');
				modal.setContent(container);

				const innerHtml = editor.getHtml();
				const css       = editor.getCss();

				htmlCodeViewer.setContent(innerHtml);
				cssCodeViewer.setContent(css);

				htmlEditor.refresh();
				cssEditor.refresh();

				modal.open();
			}
		}
	}];
}
