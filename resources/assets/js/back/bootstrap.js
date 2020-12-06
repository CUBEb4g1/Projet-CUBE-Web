// Lodash
require('lodash');
// Slugify
window.slugify = require('slugify');
// jQuery
window.$ = window.jQuery = require('jquery');
// Bootstrap
require('bootstrap');
// common.js
require('../common');

/*
 * Libs js inclues dans le thème Limitless utilisé
 * Pour les mettre à jour, supprimer l'appel de la lib, et le remplacer avec un appel de la lib téléchargée depuis npm à la place
 */
// BlockUI
require('../../themes/limitless/global_assets/js/plugins/loaders/blockui.min');
// Notifications
require('../../themes/limitless/global_assets/js/plugins/notifications/jgrowl.min');
require('../../themes/limitless/global_assets/js/plugins/notifications/noty.min');
// Appels et instanciations de base des plugins par Limitless
require('../../themes/limitless/layout_2/LTR/default/full/assets/js/app');
