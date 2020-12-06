<?php

namespace App\Services\Breadcrumb;

use Illuminate\Support\Facades\Route;

class Breadcrumb
{
	protected $breadcrumb = [];

	protected $map = [];

	public function __construct()
	{
		$this->breadcrumb = config('breadcrumb', []);
		$this->_mapBreadcrumb($this->breadcrumb);
	}

	/**
	 * Retourne le breadcrumb menant à la page actuelle
	 *
	 * @return array
	 */
	public function current(): array
	{
		return $this->get(Route::current()->getName());
	}

	/**
	 * Retourne le breadcrumb menant à la page d'une route donnée
	 *
	 * @param string $route
	 *
	 * @return array
	 */
	public function get(string $route): array
	{
		$links = [];

		if (isset($this->map[$route])) {
			$keys       = array_map('intval', explode('.', $this->map[$route]));
			$breadcrumb = $this->breadcrumb;
			$links      = [];

			foreach ($keys as $i => $key) {
				$sub = $breadcrumb[$key]['sub'] ?? [];
				unset($breadcrumb[$key]['sub']);
				$links[]    = $breadcrumb[$key];
				$breadcrumb = $sub;
			}
		}

		return $links;
	}

	/**
	 * Créer un mapping du tableau pour chercher et trouver rapidement une route et son chemin à travers
	 * le tableau du breadcrumb
	 *
	 * @param array $breadcrumb
	 * @param string|null $parentKey
	 */
	protected function _mapBreadcrumb(array $breadcrumb, string $parentKey = null): void
	{
		foreach ($breadcrumb as $key => $node) {
			// Mapping des clefs menant vers la route
			$mapKey = ($parentKey !== null ? $parentKey.'.' : '').$key;
			// Enregistrer l'entrée dans le tableau de mapping
			$this->map[$node['route']] = $mapKey;
			// S'il existe un sous-tableau répéter l'opération
			if (isset($node['sub'])) {
				$this->_mapBreadcrumb($node['sub'], $mapKey);
			}
		}
	}
}
