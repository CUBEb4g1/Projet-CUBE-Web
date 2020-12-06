<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
	const DEV               = 'dev';
	const SWITCH_AUTH       = 'switch-auth';
	const ACCESS_BACKOFFICE = 'access-backoffice';
}
