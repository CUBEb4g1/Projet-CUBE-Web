let texts = {};

/**
 * Définir le language à utiliser
 *
 * @param locale
 */
function setLocale (locale) {
	texts = require('./' + locale + '.js').default;
}

/**
 * Retourner une traduction selon sa clef passée sous le format "foo.bar.my_traduction"
 *
 * @param key
 * @private
 */
function __ (key) {
	return _getObjValByStr(texts, key);
}

/**
 * Accéder aux propriétés d'un objet selon une chaîne de caractère du type "foo.bar"
 *
 * @param o
 * @param s
 * @returns {*}
 * @private
 */
function _getObjValByStr (o, s) {
	s     = s.replace(/\[(\w+)\]/g, '.$1'); // convert indexes to properties
	s     = s.replace(/^\./, '');           // strip a leading dot
	var a = s.split('.');
	for (var i = 0, n = a.length; i < n; ++i) {
		var k = a[i];
		if (k in o) {
			o = o[k];
		} else {
			return;
		}
	}
	return o;
}

export { __, setLocale };
