<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Request;

/**
 * Trait FillableTranslations
 *
 * Fonctions complémentaires au package spatie/laravel-translatable
 *
 * @url https://github.com/spatie/laravel-translatable
 *
 * @see \Spatie\Translatable\HasTranslations
 *
 * @package App\Models\Traits
 */
trait TranslationsHelpers
{
	/**
	 * Permet de peupler plusieurs attributs d'une même traduction en même temps.
	 * Ces attributs doivent être renseignés en tant que $fillable dans le model.
	 * Si $local n'est pas définie, par défaut essaie de la récupérer depuis $attributes.
	 *
	 * @param array $attributes
	 * @param string|null $locale
	 */
	public function fillTranslations(array $attributes, string $locale = null)
	{
		$locale = $locale ?? $attributes['lang'] ?? null;

		foreach ($attributes as $attr => $val) {
			if (in_array($attr, $this->fillable)) {
				if (in_array($attr, $this->translatable) && $locale !== null) {
					$this->setTranslation($attr, $locale, $val);
				} else {
					$this->{$attr} = $val;
				}
			}
		}
	}

	/**
	 * Méthode utilisée pour peupler les inputs des formulaires.
	 * Utilise getTranslation() du Trait originel, mais récupère automatiquement la locale depuis l'url si existe un paramètre "lang".
	 * N'utilise pas de locale de fallback si la traduction n'existe pas encore.
	 *
	 * @see \Spatie\Translatable\HasTranslations::getTranslation()
	 *
	 * @param string $key
	 * @param string|null $locale
	 *
	 * @return mixed
	 */
	public function translationInput(string $key, string $locale = null, bool $useFallbackLocale = false)
	{
		return $this->getTranslation($key, $locale ?? Request::input('lang') ?? config('app.locale'), $useFallbackLocale);
	}
}
