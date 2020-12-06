<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class RoleController extends Controller
{
	/**
	 * Lister
	 */
	public function list()
	{
		return view('back.role.list', [
			'roles' => Role::with('permissions')->get(),
		]);
	}

	/**
	 * Afficher le formulaire
	 */
	public function form(Role $role = null)
	{
		if ($role !== null) {
			$users = User::role($role->name)
				->with('roles')
				->with('permissions')
				->paginate(50);
		} else {
			$users = new Collection();
		}

		return view('back.role.form', [
			'role'        => $role,
			'permissions' => Permission::with('roles')->get(),
			'users'       => $users,
		]);
	}

	/**
	 * Submit du formulaire
	 */
	public function save(Request $request, Role $role = null)
	{
		$this->_validator($request, $role);

		if ($role === null) {
			$this->_create($request);
		} else {
			$this->_update($role, $request);
		}

		return redirect()->route('back.role.list')
			->with('successNotif', __('notifications.common.saved'));
	}

	/**
	 * Créer
	 */
	protected function _create(Request $request)
	{
		$role = Role::create([
			'readable_name' => $request->input('readable_name'),
			'name'          => $request->input('name'),
		]);

		$role->syncPermissions($request->input('permissions'));
	}

	/**
	 * Modifier
	 */
	protected function _update(Role $role, Request $request)
	{
		$role->update([
			'readable_name' => $request->input('readable_name'),
			'name'          => $request->input('name'),
		]);

		$role->syncPermissions($request->input('permissions'));
	}

	/**
	 * Valider le formulaire
	 */
	protected function _validator(Request $request, Role $model = null)
	{
		$rules = [
			'readable_name' => ['required', 'max:191'],
			'name'          => ['required', 'max:191'],
		];

		if ($model !== null) {
			$rules['name'][] = 'unique:roles,name,'.$model->id;
		}

		$this->validate($request, $rules, [], [
			'readable_name' => strtolower(__('Name')),
			'name'          => strtolower(__('Unique identifier')),
		]);
	}

	/**
	 * Supprimer
	 */
	public function delete(Role $role)
	{
		$role->delete();

		return redirect()->back()
			->with('infoNotif', __('notifications.role.deleted'));
	}
}
