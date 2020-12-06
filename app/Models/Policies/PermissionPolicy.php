<?php

namespace App\Models\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
	use HandlesAuthorization;

	/**
	 * Assigner cette permission à un utilisateur
	 * && La permission n'est pas une permission dev à moins que l'auteur de l'assignation soit un dev
	 *
	 * @param User $user
	 * @param Permission $permission
	 *
	 * @return bool
	 *
	 */
	public function assign(User $user, Permission $permission)
	{
		if ($permission->name !== Permission::DEV || $user->hasPermissionTo(Permission::DEV)) {
			return true;
		}

		return false;
	}
}
