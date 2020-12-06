<?php

use App\Repositories\SettingRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\QueryException;

if (!function_exists('asset_cache')) {
	/**
	 * Ajouter à l'url d'un asset son filemtime pour que les navigateurs le mettent à jour automatiquent si le fichier
	 * a été modifié
	 *
	 * @param string $path
	 * @param bool $secure
	 *
	 * @return string
	 */
	function asset_cache(string $path, bool $secure = null)
	{
		$path .= '?v='.@filemtime(public_path($path));
		return app('url')->asset($path, $secure);
	}
}

if (!function_exists('settings')) {
	/**
	 * Retourner un paramètre enregistré en base de donnée
	 *
	 * @param string $setting
	 *
	 * @return mixed
	 *
	 * @see SettingRepository::allCached()
	 */
	function settings(string $setting)
	{
		try {
			$settingRepo = app()->make(SettingRepository::class);
			return $settingRepo->allCached()[$setting]->value;
		} catch (BindingResolutionException $e) { // Si le service container ne renvoie rien
			return null;
		} catch (QueryException $e) { // Si la table n'existe pas
			return null;
		}
	}
}

if (!function_exists('hlrt_is')) {
	/**
	 * Retourne une class CSS si une route donnée correspond à la route actuelle
	 *
	 * @param string|array $route
	 * @param string $class
	 * @param string $default
	 *
	 * @return string
	 */
	function hlrt_is($route, string $class = 'active', string $default = '')
	{
		if (is_array($route)) {
			$yes = in_array(\Route::current()->getName(), $route) === true;
		} else {
			$yes = \Route::current()->getName() === $route;
		}

		return $yes ? $class : $default;
	}
}

if (!function_exists('hlrt_begins_with')) {
	/**
	 * Retourne une class CSS si la route actuelle commence avec une chaine de caractères donnée
	 *
	 * @param string|array $beginWith
	 * @param string $class
	 * @param string $default
	 *
	 * @return string
	 */
	function hlrt_begins_with($beginWith, string $class = 'active', string $default = '')
	{
		if (is_array($beginWith)) {
			$yes = false;

			foreach ($beginWith as $match) {
				if (substr(\Route::current()->getName(), 0, strlen($match)) === $match) {
					$yes = true;
					break;
				}
			}
		} else {
			$yes = substr(\Route::current()->getName(), 0, strlen($beginWith)) === $beginWith;
		}

		return $yes ? $class : $default;
	}
}

if (!function_exists('hlrt_has_params')) {
	/**
	 * Retourne une class CSS si la route actuelle comporte certains paramètres donnés
	 * $params est un tableau $clef => $valeur, ou $clef est le nom du paramètre GET et $valeur… sa valeur
	 * $valeur peut aussi être un tableau de plusieurs valeurs
	 *
	 * @param array $params
	 * @param string $class
	 * @param string $default
	 *
	 * @return string
	 */
	function hlrt_has_params(array $params, string $class = 'active', string $default = '')
	{
		$yes         = true;
		$routeParams = \Route::current()->originalParameters();

		foreach ($params as $key => $param) {
			if (!isset($routeParams[$key]) || !in_array($routeParams[$key], (array)$param)) {
				$yes = false;
				break;
			}
		}

		return $yes === true ? $class : $default;
	}
}

if (!function_exists('hl_url_is')) {
	/**
	 * Retourne une class CSS si l'url donnée correspond à l'url actuelle
	 *
	 * @param string|array $url
	 * @param string $class
	 * @param string $default
	 *
	 * @return string
	 */
	function hl_url_is($url, string $class = 'active', string $default = '')
	{
		if (is_array($url)) {
			$yes = in_array(\URL::current(), $url) === true;
		} else {
			$yes = \URL::current() === $url;
		}

		return $yes ? $class : $default;
	}
}

if (!function_exists('hl_url_has_params')) {
	/**
	 * Retourne une class CSS si l'url actuelle comporte certains paramètres donnés
	 * $params est un tableau $clef => $valeur, ou $clef est le nom du paramètre GET et $valeur… sa valeur
	 * $valeur peut aussi être un tableau de plusieurs valeurs
	 *
	 * @param array $params
	 * @param string $class
	 * @param string $default
	 *
	 * @return string
	 */
	function hl_url_has_params(array $params, string $class = 'active', string $default = '')
	{
		$yes = true;

		foreach ($params as $key => $param) {
			if (!in_array(\Request::input($key), (array)$param)) {
				$yes = false;
				break;
			}
		}

		return $yes === true ? $class : $default;
	}
}
