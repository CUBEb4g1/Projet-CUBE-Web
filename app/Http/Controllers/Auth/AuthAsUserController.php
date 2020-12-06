<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Auth\SwitchSession;
use Illuminate\Http\Request;

class AuthAsUserController extends Controller
{
	/**
	 * Se connecter en tant qu'un autre utilisateur
	 * $this->retrievePrevAuth() permet ensuite de se reconnecter à son "vrai" compte
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function switchAuth(Request $request, SwitchSession $switchSession)
	{
		$this->authorize('switchAuth', User::findOrFail($request->input('id')));

		$switchSession->switch($request->input('id'));

		return redirect(route('home'));
	}

	/**
	 * Se reconnecter à son compte après s'être connecté en tant qu'un autre utilisateur
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function retrievePrevAuth(Request $request, SwitchSession $switchSession)
	{
		$retrieved = $switchSession->retrieve();

		if ($retrieved === false) {
			abort(403);
		}

		return redirect(route('back.dashboard'));
	}
}
