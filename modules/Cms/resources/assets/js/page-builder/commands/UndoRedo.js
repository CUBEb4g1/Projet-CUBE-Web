export default [
	{
		id: 'undo',
		run: editor => editor.UndoManager.undo()
	}, {
		id: 'redo',
		run: editor => editor.UndoManager.redo()
	}
]
