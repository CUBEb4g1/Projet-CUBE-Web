<?php

namespace App\Services\LaravelBundling\Console;

use App\Services\LaravelBundling\Facades\Module as ModuleFacade;
use App\Services\LaravelBundling\Module\Module;
use Illuminate\Console\Command;

/**
 * @version 1.0.0
 *
 * @author Alexis Weber
 */
class EnableModuleCommand extends Command
{
	/**
	 * The console command signature.
	 * @var string
	 */
	protected $signature = 'module:enable {module-name}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Enable a module';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$module = ModuleFacade::find($this->argument('module-name'));

		if (!$this->canExecuteCmd($module)) {
			return;
		}

		$module->enable();

		$this->info('The module '.$this->argument('module-name').' has been enabled');
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
		} // Everything is fine
		else {
			return true;
		}

		return false;
	}
}
