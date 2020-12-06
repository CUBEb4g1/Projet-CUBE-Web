<?php

namespace App\Services\LaravelBundling\Console;

use App\Services\LaravelBundling\Facades\Module as ModuleFacade;
use App\Services\LaravelBundling\Generator\Generator;
use App\Services\LaravelBundling\Module\Module;
use Illuminate\Console\Command;

/**
 * @version 1.0.0
 *
 * @author Alexis Weber
 */
class GenerateModuleCommand extends Command
{
	/**
	 * The console command signature.
	 * @var string
	 */
	protected $signature = 'make:module {module-name}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate a new module';

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

		$generator = new Generator($this->argument('module-name'));
		$generator->generate();

		$this->info('The module "'.$this->argument('module-name').'" has been generated');
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
		// Module already existing
		if ($module !== null) {
			$this->error('The module "'.$module->getManifest('name').'" already exists');
		} // Everything is fine
		else {
			return true;
		}

		return false;
	}
}
