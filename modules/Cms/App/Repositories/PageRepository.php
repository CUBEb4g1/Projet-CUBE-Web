<?php

namespace Modules\Cms\App\Repositories;

use App\Models\NavMenu;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Modules\Cms\App\Models\Page;

class PageRepository
{
	protected $cacheKey = 'cms_pages';

	/**
	 * Retourne les pages publiées et les placer en cache 1h
	 *
	 * @return Collection|NavMenu[]
	 */
	public function publishedCached()
	{
		return Cache::remember($this->cacheKey, 3600, function () {
			return Page::whereNotNull('id_tag')->whereOnline()->get()->keyBy('id_tag');
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
