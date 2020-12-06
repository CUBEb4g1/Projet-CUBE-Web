<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\NavItem;
use App\Models\NavMenu;
use App\Repositories\NavMenuRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Modules\Cms\App\Models\Page;

class NavMenuController extends Controller
{
	/**
	 * Affichage des liens en arbre et formulaire d'édition des différents menus
	 */
	public function list(NavMenu $menu = null)
	{
		$locations = array_flip(NavMenu::LOCATIONS);

		return view('back.menu.menu_list', [
			'pages'     => Page::all(),
			'menus'     => NavMenu::all(),
			'menu'      => $menu,
			'locations' => $locations,
		]);
	}

	/**
	 * Formulaire de création d'un menu
	 */
	public function create()
	{
		$locations = array_flip(NavMenu::LOCATIONS);

		return view('back.menu.menu_create', [
			'locations' => $locations,
		]);
	}

	/**
	 * Créer un menu
	 */
	public function add(Request $request)
	{
		$this->validate($request, [
			'name'     => 'required',
			'location' => 'required',
		]);

		$menu = NavMenu::create($request->all());

		$this->_clearNavMenuCache();

		return redirect()->route('back.menu.list')
			->with('successNotif', __('notifications.common.saved'));
	}

	/**
	 * Éditer un menu et ses items
	 */
	public function update(NavMenu $menu, Request $request)
	{
		$menu->update($request->all());

		/**    @var Collection|NavItem[] $items */
		// Liste des NavItem du NavMenu en cours d'édition
		$items = $menu->items->keyBy('id');
		// Données retournées par le formulaire concernant les NavItem
		$formDataItems = $request->input('items', []);
		// Structure de l'arbre retourné par le formulaire
		$newTree = collect(json_decode($request->input('tree'), true));
		// Ids des NavItem manquants dans le formulaire et à supprimer en bdd
		$itemsToDelete = array_diff(
			$items->pluck('id')->toArray(),
			array_keys($formDataItems)
		);

		// Mettre à jour les relations parent/enfant
		foreach ($newTree as $key => $node) {
			$items[$node['id']]->nav_item_id = $node['parent_id'];
			$items[$node['id']]->position    = $key;
		}

		// Mettre à jour les infos des items
		foreach ($formDataItems as $id => $item) {
			$item['blank'] = isset($item['blank']);
			$item['obfuscate'] = isset($item['obfuscate']);
			$items[$id]->fillTranslations($item, $request->input('lang'));
			$items[$id]->save();
		}

		// Supprimer les items qui l'ont été dans le formulaire
		foreach ($itemsToDelete as $id) {
			$items[$id]->delete();
		}

		$this->_clearNavMenuCache();

		return redirect()->back()
			->with('successNotif', __('notifications.common.saved'));
	}

	/**
	 * Supprimer une menu
	 *
	 * @param NavMenu $menu
	 */
	public function delete(NavMenu $menu)
	{
		$menu->delete();

		$redirectToMenu = NavMenu::first();

		$this->_clearNavMenuCache();

		return redirect()->route('back.menu.list', ['menu' => $redirectToMenu->id ?? null])
			->with('infoNotif', __('notifications.common.deleted'));
	}

	/**
	 * Créer un nouvel item
	 */
	public function ajaxAddItem(NavMenu $menu, Request $request)
	{
		$data          = $request->all();
		$data['blank'] = $request->has('blank');
		$data['obfuscate'] = $request->has('obfuscate');

		$lastItem = NavItem::orderBy('position', 'desc')->first();
		$newItem  = new NavItem($data);
		$newItem->fillTranslations($data, $request->input('lang'));

		$newItem->position = $lastItem->position ?? 0;

		$menu->items()->save($newItem);
		$this->_clearNavMenuCache();

		$response         = $newItem->toArray() + [
				'leadsTo' => $newItem->leadsTo(),
			];
		$response['url']  = $request->get('url');
		$response['text'] = $newItem->getSmartText($request->input('lang'), false);

		return JsonResponse::create($response);
	}

	/**
	 * Supprimer un item
	 *
	 * @param NavItem $item
	 */
	public function ajaxDeleteItem(NavItem $item)
	{
		$item->delete();

		$this->_clearNavMenuCache();

		return JsonResponse::create(['ok' => 1]);
	}

	/**
	 * Clear le cache contenant les menus
	 */
	protected function _clearNavMenuCache()
	{
		$navMenuRepo = new NavMenuRepository();
		$navMenuRepo->clearCache();
	}
}
