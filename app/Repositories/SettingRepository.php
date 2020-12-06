<?php

namespace App\Repositories;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingRepository
{
	protected $cacheKey = 'db_settings';

	/**
	 * Retourne tous les Settings et les placer en cache 1h
	 *
	 * @return Setting[]
	 */
	public function allCached()
	{
		return Cache::remember($this->cacheKey, 3600, function () {
			return Setting::all()->keyBy('name');
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
