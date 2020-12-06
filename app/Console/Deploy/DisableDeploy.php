<?php

namespace App\Console\Deploy;

use Illuminate\Console\Command;

class DisableDeploy extends Command
{
	/**
	 * The console command signature.
	 *
	 * @var string
	 */
	protected $signature = 'deploy:disable';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Disable the automatic deployment';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$configPath = base_path('.deploy/src/config.json');

		if (file_exists($configPath)) {
			$config = json_decode(file_get_contents($configPath), true);
		} else {
			$config = [];
		}

		$config['enabled'] = false;

		file_put_contents($configPath, json_encode($config, JSON_PRETTY_PRINT));
	}
}
