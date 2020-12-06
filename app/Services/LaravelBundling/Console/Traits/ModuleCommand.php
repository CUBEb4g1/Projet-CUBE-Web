<?php

namespace App\Services\LaravelBundling\Console\Traits;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * @version 1.0.1
 *
 * @author Alexis Weber
 */
class ModuleCommand extends Command
{
	/**
	 * Create a symlink to one of the bundle's folders
	 */
	protected function symlinkDirectory(string $from, string $to)
	{
		if (!File::isDirectory(dirname($to))) {
			File::makeDirectory(dirname($to), 0755, true);
		}

		if (file_exists($to)) {
			$this->warn('The "'.$to.'" directory already exists.');
		} else {
			File::link($from, $to);

			$this->info('The ['.$to.'] directory has been linked.');
		}
	}
}
