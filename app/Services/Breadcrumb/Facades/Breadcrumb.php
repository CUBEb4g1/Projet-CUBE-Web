<?php

namespace App\Services\Breadcrumb\Facades;

use Illuminate\Support\Facades\Facade;

class Breadcrumb extends Facade
{
	protected static function getFacadeAccessor()
	{
		return \App\Services\Breadcrumb\Breadcrumb::class;
	}
}
