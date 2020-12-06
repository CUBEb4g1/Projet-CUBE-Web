export default [
	{
		id: 'text-entry-only',

		run: function (editor) {
			const editAllComponents = (model, result = []) => {
				model.set({
					removable: false,
					draggable: false,
					stylable: false,
					copyable: false,
					resizable: false,
					layerable: false,
					selectable: false
				});
				result.push(model);
				model.components().each(mod => editAllComponents(mod, result));
				return result;
			};
			editAllComponents(editor.DomComponents.getWrapper());
		}
	}
]
