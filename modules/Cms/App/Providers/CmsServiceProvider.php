<?php

namespace Modules\Cms\App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Cms\App\Console\InstallModuleCommand;
use Modules\Cms\App\Repositories\PageRepository;

class CmsServiceProvider extends ServiceProvider
{
	public function boot()
	{
		$this->_loadCommands();
		$this->_loadMigrations();
		$this->_loadConfigs();
		$this->_loadTranslations();
		$this->_loadViews();
		$this->_loadRoutes();
		$this->_sharePagesToView();
	}

	public function register()
	{
		//..
	}

	protected function _loadCommands()
	{
		if ($this->app->runningInConsole()) {
			$this->commands([
				 InstallModuleCommand::class,
			]);
		}
	}

	protected function _loadMigrations()
	{
		$this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
	}

	protected function _loadConfigs()
	{
		$this->mergeConfigFrom(
			__DIR__.'/../../config/cms.php', 'cms'
		);
	}

	protected function _loadTranslations()
	{
		$this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'cms');
	}

	protected function _loadViews()
	{
		$this->loadViewsFrom(__DIR__.'/../../resources/views', 'cms');
	}

	protected function _loadRoutes()
	{
		Route::middleware('web')
			->group(__DIR__ . '/../../routes/web.php');

		Route::middleware('api')
			->prefix('api')
			->group(__DIR__ . '/../../routes/api.php');
	}

	/**
	 * Ajouter les pages qui comportent un id_tag pour les vues et les mettre en cache pdt 24h
	 */
	private function _sharePagesToView()
	{
		if (Schema::hasTable('pages')) {
			$repo     = new PageRepository();
			$cmsPages = $repo->publishedCached();
		} else {
			$cmsPages = new Collection();
		}

		View::share('cmsPages', $cmsPages);
	}
}
