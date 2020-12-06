<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PermissionController extends Controller
{
	/**
	 * Lister
	 */
	public function list()
	{
		return view('back.permission.list', [
			'permissions' => Permission::with('roles')->get(),
		]);
	}

	/**
	 * Afficher le formulaire
	 */
	public function form(Permission $permission = null)
	{
		if ($permission !== null) {
			$users = User::whereHasPermissionTo($permission->name)
				->with('roles')
				->with('permissions')
				->paginate(50);
		} else {
			$users = new Collection();
		}

		return view('back.permission.form', [
			'permission' => $permission,
			'roles'      => Role::with('permissions')->get(),
			'users'      => $users,
		]);
	}

	/**
	 * Submit du formulaire
	 */
	public function save(Request $request, Permission $permission = null)
	{
		$this->_validator($request, $permission);

		if ($permission === null) {
			$this->_create($request);
		} else {
			$this->_update($permission, $request);
		}

		return redirect()->route('back.permission.list')
			->with('successNotif', __('notifications.common.saved'));
	}

	/**
	 * Créer
	 */
	protected function _create(Request $request)
	{
		$permission = Permission::create([
			'readable_name' => $request->input('readable_name'),
			'name'          => $request->input('name'),
		]);

		$permission->syncRoles($request->input('permissions'));
	}

	/**
	 * Modifier
	 */
	protected function _update(Permission $permission, Request $request)
	{
		$permission->update([
			'readable_name' => $request->input('readable_name'),
			'name'          => $request->input('name'),
		]);
		$permission->syncRoles($request->input('permissions'));
	}

	/**
	 * Valider le formulaire
	 */
	protected function _validator(Request $request, Permission $model = null)
	{
		$rules = [
			'readable_name' => ['required', 'max:191'],
			'name'          => ['required', 'max:191'],
		];

		if ($model !== null) {
			$rules['name'][] = 'unique:permissions,name,'.$model->id;
		}

		$this->validate($request, $rules, [], [
			'readable_name' => strtolower(__('Name')),
			'name'          => strtolower(__('Unique identifier')),
		]);
	}

	/**
	 * Supprimer
	 */
	public function delete(Permission $permission)
	{
		$permission->delete();

		return redirect()->back()
			->with('infoNotif', __('notifications.permission.deleted'));
	}
}
