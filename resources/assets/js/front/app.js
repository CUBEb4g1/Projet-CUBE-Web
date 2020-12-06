/**
 * First, we will load all of this project's Javascript utilities and other dependencies.
 */

require('./bootstrap');

/**
 * Automatiquement afficher des popups de notification si le Controller a envoyé un message flash
 */
(function () {
	toastr.options.positionClass = 'toast-bottom-right';
	$.each(APP.notify, function (type, msg) {
		if (msg !== '') {
			setTimeout(function () {
				switch (type) {
					case 'info':
						toastr.info(msg);
						break;
					case 'success':
						toastr.success(msg);
						break;
					case 'warning':
						toastr.warning(msg);
						break;
					case 'danger':
						toastr.error(msg);
						break;
				}
			}, 500);
		}
	});
})();

/**
 * Obfusquer certains liens pour le maillage interne du SEO
 */
(function () {
	const $obfLink = $('.js-obflink');

	if ($obfLink.length > 0) {
		if ($obfLink.attr('tabindex') === undefined) {
			$obfLink.attr('tabindex', '0'); // Pour l'accessibilité
		}

		if ($obfLink.attr('aria-label') === undefined) {
			$obfLink.attr('aria-label', 'Cette balise est un lien cliquable'); // Pour l'accessibilité
		}

		$obfLink.on('click', function () {
			var link = atob($(this).data('o'));

			if ($(this).data('target') === '_blank') {
				window.open(link);
			} else {
				window.location = link;
			}
		});
	}
})();
