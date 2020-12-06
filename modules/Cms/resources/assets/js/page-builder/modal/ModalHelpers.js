function setModalClass (EditorModal, size) {
	document.querySelector('.gjs-mdl-dialog').classList.add('gjs-mdl-dialog-' + size);

	EditorModal.onceClose(function () {
		document.querySelector('.gjs-mdl-dialog').classList.remove('gjs-mdl-dialog-' + size);
	});
}

export { setModalClass };
