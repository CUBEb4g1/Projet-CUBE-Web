const showBlocksPanel = {
	id: 'show-blocks-panel',

	run (editor, sender) {
		const lmEl         = _getPanelEl(editor, '.blocks-panel');
		lmEl.style.display = '';
	},

	stop (editor, sender) {
		const lmEl         = _getPanelEl(editor, '.blocks-panel');
		lmEl.style.display = 'none';
	},
};

const showLayersPanel = {
	id: 'show-layers-panel',

	run (editor, sender) {
		const lmEl         = _getPanelEl(editor, '.layers-panel');
		lmEl.style.display = '';
	},

	stop (editor, sender) {
		const lmEl         = _getPanelEl(editor, '.layers-panel');
		lmEl.style.display = 'none';
	},
};

const showStylesPanel = {
	id: 'show-styles-panel',

	run (editor, sender) {
		const smEl         = _getPanelEl(editor, '.styles-panel');
		smEl.style.display = '';
	},

	stop (editor, sender) {
		const smEl         = _getPanelEl(editor, '.styles-panel');
		smEl.style.display = 'none';
	},
};

const showTraitsPanel = {
	id: 'show-traits-panel',

	run (editor, sender) {
		const smEl         = _getPanelEl(editor, '.traits-panel');
		smEl.style.display = '';
	},

	stop (editor, sender) {
		const smEl         = _getPanelEl(editor, '.traits-panel');
		smEl.style.display = 'none';
	},
};

const _getPanelEl  = function (editor, panelSelector) {
	const rowEl = editor.getContainer().closest('.builder');
	return rowEl.querySelector(panelSelector);
};

export default [showBlocksPanel, showLayersPanel, showStylesPanel, showTraitsPanel]
