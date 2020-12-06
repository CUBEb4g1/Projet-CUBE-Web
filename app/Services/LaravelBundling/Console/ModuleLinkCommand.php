<?php

namespace App\Services\LaravelBundling\Console;

use App\Services\LaravelBundling\Console\Traits\ModuleCommand;
use App\Services\LaravelBundling\Facades\Module as ModuleFacade;
use App\Services\LaravelBundling\Module\Module;

/**
 * @version 1.0.0
 *
 * @author Alexis Weber
 */
class ModuleLinkCommand extends ModuleCommand
{
	/**
	 * The console command signature.
	 * @var string
	 */
	protected $signature = 'module:link {module-name?}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a symbolic link from "public/modules/module-name/media" to "modules/ModuleName/resources/assets/media"';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$modules = [];

		if ($this->argument('module-name') !== null) {
			$modules[] = ModuleFacade::find($this->argument('module-name'));
		} else {
			$modules = ModuleFacade::all();
		}

		foreach ($modules as $module) {
			if ($this->canExecuteCmd($module)) {
				$this->symlinkDirectory(__DIR__.'/../../../../'.$module->getManifest('media-path'), public_path('modules/'.$module->getManifest('name').'/media'));
			}
		}

		return;
	}

	/**
	 * Can the module be installed
	 *
	 * @param Module $module |null
	 *
	 * @return bool
	 */
	public function canExecuteCmd(Module $module = null)
	{
		// No module existing
		if ($module === null) {
			$this->error('The module "'.$this->argument('module-name').'" does not exist');
			$this->warn('Existing modules are:');
			foreach (ModuleFacade::all() as $name => $module) {
				$this->warn('- '.$name);
			}
		} // The module has no install cmd defined in his manifest
		elseif ($module->getManifest('media-path') === null) {
			$this->warn('The module "'.$this->argument('module-name').'" has no media folder to link');
		} // Everything is fine
		else {
			return true;
		}

		return false;
	}
}
