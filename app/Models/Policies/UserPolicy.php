<?php

namespace App\Models\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
	use HandlesAuthorization;

	/**
	 * Se connecter à un autre compte utilisateur
	 * && L'utilisateur a le droit de switcher d'auth
	 * && L'utilisateur visé n'est pas un dev (à moins que l'auteur de l'action soit lui même dev)
	 *
	 * @param User $user
	 * @param User $userToUpdate
	 *
	 * @return bool
	 */
	public function switchAuth(User $user, User $userToSwitch)
	{
		return $user->hasPermissionTo(Permission::SWITCH_AUTH)
			&& (!$userToSwitch->hasPermissionTo(Permission::DEV) || $user->hasPermissionTo(Permission::DEV));
	}

	/**
	 * Modifier un utilisateur
	 * && L'utilisateur modifié n'a pas les droits de dev (à moins que l'auteur de la suppression soit lui même dev)
	 *
	 * @param User $user
	 * @param User $userToUpdate
	 *
	 * @return bool
	 */
	public function update(User $user, User $userToUpdate)
	{
		if (!$userToUpdate->hasPermissionTo(Permission::DEV) || $user->hasPermissionTo(Permission::DEV)) {
			return true;
		}

		return false;
	}

	/**
	 * Supprimer un utilisateur
	 * N'est pas l'utilisateur actuellement connecté
	 * && L'utilisateur supprimé n'a pas les droits de dev (à moins que l'auteur de la suppression soit lui même dev)
	 *
	 * @param User $user
	 * @param User $userToDelete
	 *
	 * @return bool
	 */
	public function delete(User $user, User $userToDelete)
	{
		if (
			$user->id !== $userToDelete->id
			&& (!$userToDelete->hasPermissionTo(Permission::DEV) || $user->hasPermissionTo(Permission::DEV))
		) {
			return true;
		}

		return false;
	}
}
