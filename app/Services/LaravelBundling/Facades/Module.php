<?php

namespace App\Services\LaravelBundling\Facades;

use App\Services\LaravelBundling\Module\ModuleRepository;
use Illuminate\Support\Facades\Facade;

/**
 * @version 1.0.0
 *
 * @author Alexis Weber
 */
class Module extends Facade
{
	protected static function getFacadeAccessor()
	{
		return ModuleRepository::class;
	}
}
