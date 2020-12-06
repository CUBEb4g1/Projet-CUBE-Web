<?php

namespace App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RefreshLaravelHelper extends Command
{
	/**
	 * The console command signature.
	 * @var string
	 */
	protected $signature = 'ide:refresh';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Use the 3 "ide-helper" commands';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		Artisan::call("ide-helper:generate");
		Artisan::call("ide-helper:meta");
		Artisan::call("ide-helper:models -N");

		$this->info('The Laravel IDE Helper as been entirely regenerated');
	}
}
