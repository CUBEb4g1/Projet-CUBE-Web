/**
 * First, we will load all of this project's Javascript utilities and other dependencies.
 */

require('./bootstrap');

require('./menu/menu_list');

/**
 * Automatiquement afficher des popups de notification si le Controller a envoyé un message flash
 */
$.jGrowl.defaults.closer = false;
$.each(APP.notify, function (type, msg) {
	if (msg !== '') {
		switch (type) {
			case 'info':
				$.jGrowl(msg, { position: 'bottom-right', theme: 'bg-info' });
				break;
			case 'success':
				$.jGrowl(msg, { position: 'bottom-right', theme: 'bg-success' });
				break;
			case 'warning':
				$.jGrowl(msg, { position: 'bottom-right', theme: 'bg-warning' });
				break;
			case 'danger':
				$.jGrowl(msg, { position: 'bottom-right', theme: 'bg-danger' });
				break;
		}
	}
});

/**
 * Init les tooltips de Bootstrap
 */
$('[data-toggle="tooltip"]').tooltip();
