<?php

namespace App\Console;

use Illuminate\Console\Command;

class AssetsMediaLink extends Command
{
	/**
	 * The console command signature.
	 *
	 * @var string
	 */
	protected $signature = 'assets_media:link';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a symbolic link from "public/media" to "assets/media"';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		if (file_exists(public_path('media'))) {
			$this->error('The "public/media" directory already exists.');
			return;
		}

		$this->laravel->make('files')->link(
			resource_path('assets/media'), public_path('media')
		);

		$this->info('The [public/media] directory has been linked.');
	}
}
