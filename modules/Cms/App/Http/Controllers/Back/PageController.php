<?php

namespace Modules\Cms\App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Repositories\NavMenuRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Modules\Cms\App\Models\Page;
use Modules\Cms\App\Repositories\PageRepository;

class PageController extends Controller
{
	/*
	 * Lister
	 */
	public function list(Request $request)
	{
		$query = $this->_addFiltersToQuery(Page::query(), $request);
		$pages = $query->orderBy('online')->orderByDesc('id')->get();

		return view('cms::back.page.list', [
			'pages' => $pages,
		]);
	}

	/**
	 * Afficher le formulaire
	 */
	public function form(Request $request, int $page = null)
	{
		$page = Page::where('id', $page)->withTrashed()->first();

		return view('cms::back.page.form', [
			'page' => $page,
		]);
	}

	/**
	 * Submit du formulaire
	 */
	public function save(Request $request, PageRepository $pageRepo, int $page = null)
	{
		$page = Page::where('id', $page)->withTrashed()->first();

		$request->validate([
			'title' => 'required|max:254',
			'slug'  => 'required|max:254',
		]);

		if ($page === null) {
			$page = $this->_create($request);
		} else {
			$page = $this->_update($page, $request);
		}

		$pageRepo->clearCache();

		// Rester sur le formulaire ou revenir à la liste
		$route = (boolean)$request->input('stay') === true
			? route('back.page.form', ['page' => $page->id])
			: route('back.page.list', ['cat' => $request->input('cat')]);

		return redirect($route)
			->with('successNotif', __('notifications.page.saved'));
	}

	/**
	 * Créer
	 */
	protected function _create(Request $request)
	{
		$page = Page::create(array_merge(['online' => false], $request->all()));
		$page->sanitizeLocalUrls();
		$page->save();
		return $page;
	}

	/**
	 * Modifier
	 */
	protected function _update(Page $page, Request $request)
	{
		$page->update(array_merge(['online' => false], $request->all()));
		$page->sanitizeLocalUrls();
		$page->save();
		return $page;
	}

	/**
	 * Ajouter à la corbeille
	 *
	 * @param \Modules\Cms\App\Models\Page $page
	 */
	public function trash(Page $page)
	{
		$page->delete();

		return redirect()->back()
			->with('infoNotif', __('notifications.page.trashed'));
	}

	/**
	 * Retirer de la corbeille
	 */
	public function restore(int $page)
	{
		$page = Page::where('id', $page)->withTrashed()->firstorFail();
		$page->restore();

		return redirect()->back()
			->with('infoNotif', __('notifications.page.restored'));
	}

	/**
	 * Supprimer
	 */
	public function delete(int $page, NavMenuRepository $navMenuRepo)
	{
		$page = Page::where('id', $page)->withTrashed()->firstorFail();
		$page->forceDelete();

		$navMenuRepo->clearCache();

		return redirect()->back()
			->with('infoNotif', __('notifications.page.deleted'));
	}

	/**
	 * Selon des filtres reçus en paramètre GET, ajouter certaines règles à la requête SQL passée
	 *
	 * @param Builder $query
	 * @param Request $request
	 *
	 * @return Builder
	 */
	protected function _addFiltersToQuery(Builder $query, Request $request)
	{
		// Filtre: Récupérer les pages brouillons (pas encore en ligne), ou les pages dans la corbeille
		if ($request->has('cat')) {
			if ($request->input('cat') === 'draft') {
				$query->where('online', false);
			} elseif ($request->input('cat') === 'trashed') {
				$query->onlyTrashed();
			}
		}

		return $query;
	}
}
