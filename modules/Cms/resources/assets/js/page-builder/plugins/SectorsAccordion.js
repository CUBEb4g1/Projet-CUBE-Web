export default (editor) => {
	function _delegate (el, evt, sel, handler) {
		el.addEventListener(evt, function (event) {
			var t = event.target;
			while (t && t !== this) {
				if (t.matches(sel)) {
					handler.call(t, event);
				}
				t = t.parentNode;
			}
		});
	}

	_delegate(editor.getContainer().closest('.builder'), "click", ".styles-panel .gjs-sm-sector .gjs-sm-title", function (event) {
		const panel     = this.closest('.styles-panel');
		const sectors   = panel.querySelectorAll('.gjs-sm-sector.gjs-sm-open');
		const curSector = this.closest('.gjs-sm-sector');

		if (!curSector.classList.contains('sector-to-close')) {
			sectors.forEach(function (el) {
				if (el !== curSector) {
					el.classList.add('sector-to-close');
					el.querySelector('.gjs-sm-title').click();
					el.classList.remove('sector-to-close');
				}
			});
		}
	});
}
