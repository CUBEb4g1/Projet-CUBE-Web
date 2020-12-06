<?php

namespace App\Models\Policies;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
	use HandlesAuthorization;

	/**
	 * Assigner ce role à un utilisateur
	 * && Le Role n'inclue pas une permission de dev à moins que l'auteur de l'assignation soit un dev
	 *
	 * @param User $user
	 * @param Role $role
	 *
	 * @return bool
	 *
	 */
	public function assign(User $user, Role $role)
	{
		if (!$role->hasPermissionTo(Permission::DEV) || $user->hasPermissionTo(Permission::DEV)) {
			return true;
		}

		return false;
	}
}
