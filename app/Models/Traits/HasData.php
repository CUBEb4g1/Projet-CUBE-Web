<?php

namespace App\Models\Traits;

/**
 * Trait HasData
 *
 * @property array $attributes
 * @property array $casts
 */
trait HasData
{
	/**
	 * This method is called upon instantiation of the Eloquent Model.
	 *
	 * @return void
	 */
	public function initializeHasData()
	{
		$this->attributes['data'] = '{}';
		$this->casts['data']      = 'array';
	}

	/**
	 * Les paramètres par défaut
	 *
	 * @return array
	 */
	public function defaultData()
	{
		return [];
	}

	/*
	|--------------------------------------------------------------------------
	| ACCESSORS & MUTATORS
	|--------------------------------------------------------------------------
	*/

	/**
	 * Retourne les data du model
	 * Tous ceux qui ne sont pas dans le tableau par défaut sont effacés par sécurité
	 *
	 * @param $value
	 *
	 * @return array
	 */
	public function getDataAttribute($value): array
	{
		$defaultData = $this->defaultData();
		$userData    = array_intersect_key(json_decode($value, true) ?? [], $defaultData);

		return array_merge($defaultData, $userData);
	}

	/**
	 * Met à jour les data du model
	 * Tous ceux qui ne sont pas dans le tableau par défaut sont effacés par sécurité
	 *
	 * @param array $value
	 */
	public function setDataAttribute(array $value): void
	{
		$defaultData = $this->defaultData();
		$newData     = array_intersect_key($value, $defaultData);

		$this->attributes['data'] = json_encode(array_merge($defaultData, $newData));
	}
}
