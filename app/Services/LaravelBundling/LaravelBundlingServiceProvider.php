<?php

namespace App\Services\LaravelBundling;

use App\Services\LaravelBundling\Console\DisableModuleCommand;
use App\Services\LaravelBundling\Console\EnableModuleCommand;
use App\Services\LaravelBundling\Console\GenerateModuleCommand;
use App\Services\LaravelBundling\Console\InstallModuleCommand;
use App\Services\LaravelBundling\Console\ModuleLinkCommand;
use App\Services\LaravelBundling\Facades\Module;
use App\Services\LaravelBundling\Module\ModuleRepository;
use Illuminate\Support\ServiceProvider;

/**
 * @version 1.0.0
 *
 * @author Alexis Weber
 */
class LaravelBundlingServiceProvider extends ServiceProvider
{
	protected $defer = false;

	public function boot()
	{
		Module::scan();
		Module::boot();
	}

	public function register()
	{
		$this->registerAliases();
		$this->loadCommands();
		$this->registerServices();
	}

	public function loadCommands()
	{
		if ($this->app->runningInConsole()) {
			$this->commands([
				 DisableModuleCommand::class,
				 EnableModuleCommand::class,
				 GenerateModuleCommand::class,
				 InstallModuleCommand::class,
				 ModuleLinkCommand::class,
			]);
		}
	}

	protected function registerAliases()
	{
		$this->app->alias('Module', 'App\Services\LaravelBundling\Facades\Module');
	}

	protected function registerServices()
	{
		$this->app->singleton(ModuleRepository::class, function ($app) {
			return new ModuleRepository($app);
		});
	}
}
