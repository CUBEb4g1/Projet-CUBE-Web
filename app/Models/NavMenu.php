<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavMenu extends Model
{
	const LOCATIONS = [
		'menu' => 'Menu principal',
	];

	protected $fillable = ['name', 'location'];

	/*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/

	public function items()
	{
		return $this->hasMany(NavItem::class);
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
	 * S'assurer que l'emplacement passé est défini dans la constante self::LOCATIONS
	 *
	 * @param $value
	 */
	public function setLocationAttribute($value)
	{
		if (array_key_exists($value, self::LOCATIONS)) {
			$this->attributes['location'] = $value;
		}
	}

	/*
	|--------------------------------------------------------------------------
	| GETTERS
	|--------------------------------------------------------------------------
	*/

	/**
	 * Retourne les items sous forme d'arbre parent-enfant
	 */
	public function getTree()
	{
		return $this->_makeTree($this->items->sortBy('position'));
	}

	/*
	|--------------------------------------------------------------------------
	| LOGIC FUNCTIONS
	|--------------------------------------------------------------------------
	*/

	/**
	 * Générer l'arbre de la relation parent-enfant
	 */
	protected function _makeTree($items, $parentId = null)
	{
		$tree = [];

		foreach ($items as $key => $item) {
			if (($item->nav_item_id === null && $parentId === null) || $item->nav_item_id === $parentId) {
				unset($items[$key]);

				$tree[$item->id] = [
					'item'     => $item,
					'children' => $this->_makeTree($items, $item->id),
				];
			} elseif ($item->nav_item_id === null) {
				break;
			}
		}

		return $tree;
	}
}
