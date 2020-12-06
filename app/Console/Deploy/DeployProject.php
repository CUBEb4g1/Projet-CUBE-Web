<?php

namespace App\Console\Deploy;

use Illuminate\Console\Command;

class DeployProject extends Command
{
	/**
	 * The console command signature.
	 *
	 * @var string
	 */
	protected $signature = 'deploy:run {--d|dev}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Deploy the project, using all the necessary laravel, npm… commands';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		if ($this->option('dev')) {
			system('php '.base_path('.deploy/deploy-dev.php'));
		} else {
			system('php '.base_path('.deploy/deploy.php'));
		}
	}
}
