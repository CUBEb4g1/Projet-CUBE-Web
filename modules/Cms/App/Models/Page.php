<?php

namespace Modules\Cms\App\Models;

use App\Models\Traits\HasData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
	use HasData;
	use HasTranslations;
	use SoftDeletes;

	const ID_TAGS = [];

	protected $fillable = [
		'id_tag',
		'title',
		'slug',
		'meta_description',
		'html',
		'css',
		'gjs_components',
		'gjs_styles',
		'online',
	];

	protected $casts = [
		'online' => 'boolean',
	];

	public $translatable = [
		'title',
		'slug',
		'meta_description',
		'html',
		'css',
		'gjs_components',
		'gjs_styles',
	];

	public function defaultData()
	{
		return [
			//
		];
	}

	/*
	|--------------------------------------------------------------------------
	| SCOPES
	|--------------------------------------------------------------------------
	*/

	public function scopeWhereOnline(Builder $query)
	{
		return $query->where('online', true);
	}

	/*
	|--------------------------------------------------------------------------
	| ACCESSORS & MUTATORS
	|--------------------------------------------------------------------------
	*/

	/**
	 * N'accepter l'id_tag que s'il est bien référencé dans la constante
	 *
	 * @param $value
	 */
	public function setIdTagAttribute($value)
	{
		if (in_array($value, self::ID_TAGS) || $value === null) {
			$this->attributes['id_tag'] = $value;
		}
	}

	/*
	|--------------------------------------------------------------------------
	| LOGIC FUNCTIONS
	|--------------------------------------------------------------------------
	*/

	/**
	 * Retirer le domaine des url locales pour qu'elles soient bien des urls relatives
	 */
	public function sanitizeLocalUrls()
	{
		// Supprimer le slash de fin si existant
		$siteUrl = preg_replace('/\/$/', '', Request::getSchemeAndHttpHost());
		$regex   = '~('.$siteUrl.')~';

		foreach ($this->getTranslations('html') as $locale => $html) {
			$this->setTranslation('html', $locale, preg_replace($regex, '', $html));
		}

		foreach ($this->getTranslations('gjs_components') as $locale => $gjsComponent) {
			$this->setTranslation('gjs_components', $locale, preg_replace($regex, '', $gjsComponent));
		}

		foreach ($this->getTranslations('css') as $locale => $css) {
			$this->setTranslation('css', $locale, preg_replace($regex, '', $css));
		}

		foreach ($this->getTranslations('gjs_styles') as $locale => $gjsStyle) {
			$this->setTranslation('gjs_styles', $locale, preg_replace($regex, '', $gjsStyle));
		}
	}
}
