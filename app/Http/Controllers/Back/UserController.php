<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Notifications\NotifyNewUserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	/**
	 * Lister
	 */
	public function list()
	{
		return view('back.user.list', [
			'users' => User::with('roles')->with('permissions')->paginate(25),
		]);
	}

	/**
	 * Afficher le formulaire
	 */
	public function form(User $user = null)
	{
		if ($user !== null) {
			$this->authorize('update', $user);
		}

		return view('back.user.form', [
			'user'                    => $user,
			'userRoles'               => $user ? $user->roles->pluck('id') : new Collection(),
			'userPermissions'         => $user ? $user->getAllUserPermissions()->pluck('id') : new Collection(),
			'userPermissionsViaRoles' => $user ? $user->getPermissionsViaRoles()->pluck('id') : new Collection(),
			'userDirectPermissions'   => $user ? $user->getDirectPermissions() : new Collection(),
			'roles'                   => Role::with('permissions')->get(),
			'permissions'             => Permission::with('roles')->get(),
		]);
	}

	/**
	 * Submit du formulaire
	 *
	 * @param Request $request
	 */
	public function save(Request $request, User $user = null)
	{
		$this->_validator($request, $user);

		if ($user === null) {
			$user = $this->_create($request);
		} else {
			$this->_update($user, $request);
		}

		$roles       = Role::whereIn('id', $request->input('roles', []))->with('permissions')->get();
		$permissions = Permission::whereIn('id', $request->input('permissions', []))->with('roles')->get();

		$user->syncRoles($roles);
		$user->syncPermissions($permissions);

		return redirect()->route('back.user.list')
			->with('successNotif', __('notifications.common.saved'));
	}

	/**
	 * Valider le formulaire
	 */
	protected function _validator(Request $request, User $model = null)
	{
		$rules = [
			'username' => ['required', 'max:191'],
			'email'    => ['required', 'email', 'max:191'],
			'password' => ['max:191'],
		];

		if ($model === null) {
			$rules['username'][] = 'unique:users';
			$rules['email'][]    = 'unique:users';
			$rules['password'][] = 'required';
		} else {
			$rules['username'][] = 'unique:users,username,'.$model->id;
			$rules['email'][]    = 'unique:users,email,'.$model->id;
			$rules['password'][] = 'nullable';
		}

		$this->validate($request, $rules);
	}

	/**
	 * Créer
	 */
	protected function _create(Request $request)
	{
		$user                    = User::create($request->all());
		$user->password          = Hash::make($request->input('password'));
		$user->email_verified_at = new Carbon();
		$user->save();

		$user->notify(new NotifyNewUserAccount($user, $request->input('password')));

		return $user;
	}

	/**
	 * Modifier
	 */
	protected function _update(User $user, Request $request)
	{
		$this->authorize('update', $user);
		$user->update($request->except('password'));

		if ($request->filled('password')) {
			$user->password = Hash::make($request->input('password'));
			$user->save();
		}
	}

	/**
	 * Supprimer
	 *
	 * @param User $user
	 */
	public function delete(User $user)
	{
		$this->authorize('delete', $user);

		$user->delete();

		return redirect()->back()
			->with('infoNotif', __('notifications.user.deleted'));
	}
}
