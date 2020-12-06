<?php

namespace Modules\Cms\App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Modules\Cms\App\Models\Page;

class PageBuilderController extends Controller
{

	/**
	 * Éditeur de page
	 *
	 * @param Page $page
	 */
	public function editor(Page $page)
	{
		$this->authorize('useEditor', Page::class);

		return view('cms::back.page.page_builder', [
			'page' => $page,
		]);
	}

	/**
	 * Enregistrer une page
	 *
	 * @param Page $page
	 * @param Request $request
	 *
	 * @return JsonResponse
	 */
	public function save(Page $page, Request $request)
	{
		$page->html           = $request->input('gjs-html');
		$page->css            = $request->input('gjs-css');
		$page->gjs_components = $request->input('gjs-components');
		$page->gjs_styles     = $request->input('gjs-styles');

		$page->save();

		return JsonResponse::create(['ok' => 1]);
	}

	/**
	 * Load une page
	 *
	 * @param Page $page
	 *
	 * @return JsonResponse
	 */
	public function load(Page $page)
	{
		$gjsPage = [];

		if ($page->gjs_components) {
			$gjsPage['gjs-components'] = $page->gjs_components;
		} else {
			$gjsPage['gjs-html'] = $page->html;
		}

		if ($page->gjs_styles) {
			$gjsPage['gjs-styles'] = $page->gjs_styles;
		} else {
			$gjsPage['gjs-css'] = $page->css;
		}

		return JsonResponse::create($gjsPage);
	}

	/**
	 * Uploader un fichier
	 *
	 * @param Request $request
	 *
	 * @return JsonResponse
	 */
	public function upload(Request $request)
	{
		$uploaded = [];

		foreach ($request->file('files') as $file) {
			$rnd      = Carbon::now()->format('Ymdis').substr(md5(rand()), 0, 20);
			$fileName = $rnd.'.'.$file->guessExtension();

			$newFile = @Storage::disk('public')->putFileAs('cms', $file, $fileName);

			// Si uploadé avec succès
			if ($newFile) {
				$uploaded[] = asset('storage/'.$newFile);
			}
		}

		return JsonResponse::create([
			'data' => $uploaded,
		]);
	}

	public function uploadedFiles()
	{
		$files = array_slice(Storage::disk('public')->allFiles('cms'), 0, 50);

		array_walk($files, function (&$file) {
			$file = asset('storage/'.$file);
		});

		return JsonResponse::create($files);
	}
}
