<?php

use App\Models\Permission;
use Modules\Cms\App\Http\Controllers\Back\PageBuilderController;
use Modules\Cms\App\Http\Controllers\Back\PageController as BackPageController;
use Modules\Cms\App\Http\Controllers\Front\PageController as FrontPageController;

// === PAGES ===
Route::group([
	'prefix'     => LaravelLocalization::setLocale(),
	'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
	Route::name('page.show')->get('/{slug}-{id}', [FrontPageController::class, 'show'])->where(['slug' => '(.)+', 'id' => '\d+']);
});

Route::prefix(config('admin.backoffice_prefix'))->middleware(['auth', 'verified', 'permission:'.Permission::ACCESS_BACKOFFICE])->group(function () {
	Route::prefix('cms')->group(function () {
		// === PAGES ===
		// Crud classique
		Route::name('back.page.list')->get('page', [BackPageController::class, 'list']);
		Route::name('back.page.form')->get('page/form/{page?}', [BackPageController::class, 'form']);
		Route::name('back.page.save')->post('page/form/{page?}', [BackPageController::class, 'save']);
		Route::name('back.page.trash')->get('page/trash/{page}', [BackPageController::class, 'trash'])->where(['page' => '\d+']);
		Route::name('back.page.restore')->get('page/restore/{page}', [BackPageController::class, 'restore'])->where(['page' => '\d+']);
		Route::name('back.page.delete')->get('page/delete/{page}', [BackPageController::class, 'delete'])->where(['page' => '\d+']);
		// Page builder
		Route::name('back.page.page_builder')->get('page/builder/edit/{page?}', [PageBuilderController::class, 'editor']);
		Route::name('back.page.page_builder.save')->post('page/builder/save/{page?}', [PageBuilderController::class, 'save'])->where(['page' => '\d*']);
		Route::name('back.page.page_builder.load')->get('page/builder/load/{page}', [PageBuilderController::class, 'load'])->where(['page' => '\d+']);
		Route::name('back.page.page_builder.upload')->post('page/builder/upload', [PageBuilderController::class, 'upload']);
		Route::name('back.page.page_builder.uploaded_files')->get('page/builder/uploaded-files', [PageBuilderController::class, 'uploadedFiles']);
	});
});
