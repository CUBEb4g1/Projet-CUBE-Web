<?php

namespace App\Models;

use App\Models\Traits\HasData;
use App\Models\Traits\TranslationsHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Modules\Cms\App\Models\Page;
use Spatie\Translatable\HasTranslations;

class NavItem extends Model
{
	use HasData;
	use HasTranslations;
	use TranslationsHelpers;

	protected $fillable = [
		'page_id',
		'text',
		'url',
		'blank',
		'obfuscate',
		'data',
	];

	protected $casts = [
		'blank'     => 'boolean',
		'obfuscate' => 'boolean',
	];

	public $translatable = [
		'text',
		'url',
	];

	public function defaultData()
	{
		return [
			'id'    => null,
			'class' => null,
		];
	}

	/*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/

	protected $with = [
		'page'
	];

	public function menus()
	{
		return $this->belongsTo(NavMenu::class);
	}

	public function parent()
	{
		return $this->belongsTo(NavItem::class, 'nav_item_id');
	}

	public function children()
	{
		return $this->hasMany(NavItem::class, 'nav_item_id');
	}

	public function page()
	{
		return $this->belongsTo(Page::class)->withTrashed();
	}

	/*
	|--------------------------------------------------------------------------
	| SCOPES
	|--------------------------------------------------------------------------
	*/

	/*
	|--------------------------------------------------------------------------
	| EVENTS
	|--------------------------------------------------------------------------
	*/

	/*
	|--------------------------------------------------------------------------
	| ACCESSORS & MUTATORS
	|--------------------------------------------------------------------------
	*/

	/**
	 * Si c'est une url interne, retirer le domaine si celui-ci a été saisi
	 *
	 * @param $value
	 */
	public function setUrlAttribute($value)
	{
		// Regex pour supprimer "http(s)://www."
		$http3wRegex = '(?:https?://)?(?:www.)?';
		// Récupérer le domaine sans le http.www
		$domain = preg_replace('('.$http3wRegex.')', '', config('app.url'));
		// Retirer le domaine de l'url si c'est une url interne
		$cleanUrl = preg_replace('('.$http3wRegex.$domain.')', '', $value, -1, $cleaned);

		// Si c'est une url interne, s'assurer qu'elle commence bien par "/"
		if ($cleaned > 0 && substr($cleanUrl, 0, 1) !== '/') {
			$cleanUrl = '/'.$cleanUrl;
		}

		$this->attributes['url'] = $cleanUrl;
	}

	/*
	|--------------------------------------------------------------------------
	| GETTERS
	|--------------------------------------------------------------------------
	*/

	/**
	 * Retourne une chaîne de caractère qui décrit ce vers quoi le NavItem mène (une simple url, une page etc…)
	 *
	 * @return string
	 */
	public function leadsTo()
	{
		if ($this->page_id !== null) {
			return 'page';
		} elseif (!empty($this->url)) {
			return 'url';
		} else {
			return 'void';
		}
	}

	/**
	 * Si l'attribute "text" est vide, essaie de le retourner en fonction du nom de la page par exemple
	 *
	 * @return string|null
	 */
	public function getSmartText(string $lang = null, bool $useFallbackLocale = true)
	{
		if (!empty($text = $this->getTranslation('text', $lang ?? config('app.locale'), false))) {
			return $text;
		}

		switch ($this->leadsTo()) {
			case 'page':
				return $lang ? $this->page->getTranslation('title', $lang, false) : $this->page->title;
			case 'url':
				return $this->url;
			default:
				return null;
		}
	}

	/**
	 * Retourne l'url vers laquelle le NavItem mène (une page, une simple url etc…)
	 *
	 * @return mixed|string|null
	 */
	public function leadsToUrl()
	{
		switch ($this->leadsTo()) {
			case 'page':
				return route('page.show', ['slug' => $this->page->slug, 'id' => $this->page->id]);
			case 'url':
				return $this->url;
			default:
				return null;
		}
	}

	/*
	|--------------------------------------------------------------------------
	| LOGIC FUNCTIONS
	|--------------------------------------------------------------------------
	*/

	/**
	 * Le lien est-il censé être obfusqué dans le contexte actuel de navigation
	 * Les liens ne sont pas obfusqués sur la home
	 *
	 * @return bool
	 */
	public function shouldBeObfuscated(): bool {
		return $this->obfuscate === true && Route::getCurrentRoute()->getName() !== 'home';
	}
}
