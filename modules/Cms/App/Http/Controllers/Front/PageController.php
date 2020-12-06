<?php

namespace Modules\Cms\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Modules\Cms\App\Models\Page;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class PageController extends Controller
{
	public function show(string $slug, int $id, Request $request)
	{
		// Récupérer une page en preview si demandée
		$page = $request->has('preview')
			? Page::where('id', $id)->firstOrFail()
			: Page::where('id', $id)->whereOnline()->firstOrFail();
		// Jeter une erreur 404 plutôt qu'une erreur 403 si pas les droits de voir la page
		try {
			$this->authorize('show', $page);
		} catch (AuthorizationException $e) {
			abort(404);
		}
		// Protéger le slug
		if (($redirect = $this->assertSlug($page, $request)) !== true) {
			return $redirect;
		}

		return view('cms::front.page.show', [
			'page' => $page,
		]);
	}

	/**
	 * Si le slug est différent du vrai, rediriger la page à la bonne url
	 *
	 * @param \Modules\Cms\App\Models\Page $page
	 * @param Request $request
	 *
	 * @return bool|\Illuminate\Http\RedirectResponse
	 */
	protected function assertSlug(Page $page, Request $request)
	{
		if ($page->slug !== $request->route('slug')) {
			return redirect()->route('page.show', [
				'slug' => $page->slug,
				'id'   => $page->id,
			]);
		} else {
			return true;
		}
	}
}
