/**
 * Print un objet en console au moment où la fonction est appelée (comme console.dir())
 */
dump = function (v) {
	console.log($.parseJSON(JSON.stringify(v)));
};

/**
 * Délayer l'exécution d'une fonction passée et bloquer son utilisation durant ce temps
 * delay(function() {alert('Hello World!');}, 500);
 */
delay = (function () {
	var timer = 0;
	return function (callable, ms) {
		clearTimeout(timer);
		timer = setTimeout(callable, ms);
	};
})();

/**
 * Vérifier qu'une objet html possède un attribut data donné
 *
 * @param data
 *
 * @returns {boolean}
 */
$.fn.hasDataProp = function (data) {
	// return typeof this.data(data) !== typeof undefined && this.data(data) !== false;
	return typeof this.data(data) !== typeof undefined;
};

/**
 * Retourner un attribut data ou une valeur par défaut
 *
 * @param data
 * @param defaultVar
 *
 * @returns {*}
 */
$.fn.getDataProp = function (data, defaultVar) {
	return this.hasDataProp(data) === true ? this.data(data) : _.defaultTo(defaultVar, null);
};
