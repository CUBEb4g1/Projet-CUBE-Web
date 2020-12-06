<?php

namespace Modules\Cms\App\Models\Policies;

use Modules\Cms\App\Models\Page;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class PagePolicy
{
	use HandlesAuthorization;

	/**
	 * Afficher une page CMS
	 * La page est publiée
	 * || La page est en preview mais l'utilisateur à les bons droits
	 *
	 * @param User $user
	 * @param \Modules\Cms\App\Models\Page $page
	 *
	 * @return bool
	 */
	public function show(?User $user, Page $page)
	{
		if (Request::has('preview')) {
			if (Auth::guest() || !Auth::user()->hasPermissionTo(Permission::ACCESS_BACKOFFICE)) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Utiliser l'éditeur de page et modifier le layout de la page
	 * Le paramètre est activé
	 * || L'utilisateur est un développeur
	 *
	 * @param User $user
	 *
	 * @return boolean
	 */
	public function useEditor(User $user): bool
	{
		return settings('cms_layout_editable') || $user->hasPermissionTo(Permission::DEV);
	}
}
