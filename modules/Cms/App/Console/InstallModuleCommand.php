<?php

namespace Modules\Cms\App\Console;

use App\Services\LaravelBundling\Console\Traits\ModuleCommand;

class InstallModuleCommand extends ModuleCommand
{
	/**
	 * The console command signature.
	 * @var string
	 */
	protected $signature = 'cms-module:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Install the Cms module';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		system('composer require larabase/cms @dev');
		system('npm install '.base_path('modules/Cms'));
		$this->call('module:link', ['module-name' => 'cms']);
	}
}
