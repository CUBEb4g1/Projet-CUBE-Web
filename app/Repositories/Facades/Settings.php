<?php

namespace App\Repositories\Facades;

use Illuminate\Support\Facades\Facade;

class Settings extends Facade
{
	protected static function getFacadeAccessor()
	{
		return \App\Repositories\SettingRepository::class;
	}
}
