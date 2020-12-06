<?php

namespace App\Repositories;

use App\Models\NavMenu;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class NavMenuRepository
{
	protected $cacheKey = 'nav_menu';

	/**
	 * Retourne tout et les placer en cache 1h
	 *
	 * @return Collection|NavMenu[]
	 */
	public function allCached()
	{
		return Cache::remember($this->cacheKey, 3600, function () {
			return NavMenu::with('items')->with('items.page')->get()->keyBy('location');
		});
	}

	/**
	 * Effacer les résultats en cache
	 */
	public function clearCache()
	{
		Cache::forget($this->cacheKey);
	}
}
