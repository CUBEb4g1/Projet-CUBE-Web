<?php

namespace App\Models\Traits;

/**
 * Trait HasSettings
 *
 * @property array $attributes
 * @property array $casts
 */
trait HasSettings
{
	/**
	 * This method is called upon instantiation of the Eloquent Model.
	 *
	 * @return void
	 */
	public function initializeHasSettings()
	{
		$this->attributes['settings'] = '{}';
		$this->casts['settings']      = 'array';
	}

	/**
	 * Les paramètres par défaut
	 *
	 * @return array
	 */
	public function defaultSettings()
	{
		return [];
	}

	/*
	|--------------------------------------------------------------------------
	| ACCESSORS & MUTATORS
	|--------------------------------------------------------------------------
	*/

	/**
	 * Retourne les settings du model
	 * Tous ceux qui ne sont pas dans le tableau par défaut sont effacés par sécurité
	 *
	 * @param $value
	 *
	 * @return array
	 */
	public function getSettingsAttribute($value): array
	{
		$defaultSettings = $this->defaultSettings();
		$userSettings    = array_intersect_key(json_decode($value, true) ?? [], $defaultSettings);

		return array_merge($defaultSettings, $userSettings);
	}

	/**
	 * Met à jour les settings du model
	 * Tous ceux qui ne sont pas dans le tableau par défaut sont effacés par sécurité
	 *
	 * @param array $value
	 */
	public function setSettingsAttribute(array $value): void
	{
		$defaultSettings = $this->defaultSettings();
		$newSettings     = array_intersect_key($value, $defaultSettings);

		$this->attributes['settings'] = json_encode(array_merge($defaultSettings, $newSettings));
	}
}
