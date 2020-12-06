<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController
{
	/**
	 * Afficher le formulaire
	 */
	public function parameters()
	{
		return view('back.account.parameters', [
			'user' => Auth::user(),
		]);
	}

	/**
	 * Submit du formulaire
	 *
	 * @param Request $request
	 */
	public function saveParameters(Request $request)
	{
		$request->validate([
			'avatar'   => 'nullable|image',
			'username' => 'required|min:3|max:255',
			'email'    => 'required|email|max:255',
			'password' => 'nullable|max:191',
		]);

		Auth::user()->update($request->except('password'));

		if ($request->filled('password')) {
			Auth::user()->password = Hash::make($request->input('password'));
			Auth::user()->save();
		}

		if ($request->has('avatar')) {
			Auth::user()->attachFile('avatar', $request->file('avatar'));
		}

		return redirect()->route('back.account.parameters')
			->with('successNotif', __('notifications.common.saved'));
	}
}
