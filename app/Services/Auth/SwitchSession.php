<?php

namespace App\Services\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @version 1.0.0
 *
 * @author Alexis Weber
 */
class SwitchSession
{
	const AUTH_SESSION_KEY = 'id_user_connected_as';

	protected $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * Se connecter en tant qu'un autre utilisateur
	 *
	 * @see SwitchSession::retrieve() Permet ensuite de se reconnecter à son "vrai" compte
	 *
	 * @param int $userId
	 * @param Request $request
	 *
	 * @return bool
	 */
	public function switch(int $userId)
	{
		if (Auth::check()) {
			// Id de l'utilisateur entrain de switcher de session
			$switchingUserId = \Auth::user()->id;
			// Essayer de se connecter à l'utilisateur donné
			$logged = \Auth::loginUsingId($userId);

			// Si l'utilisateur existe bien
			if ($logged !== false) {
				// Enregistrer l'id de l'utilisateur qui a switché pour pouvoir plus tard le reconnecter à son "vrai" compte
				$this->request->session()->put(self::AUTH_SESSION_KEY, $switchingUserId);

				return true;
			}
		}

		return false;
	}

	/**
	 * Se reconnecter à son compte après s'être connecté en tant qu'un autre utilisateur
	 *
	 * @param Request $request
	 *
	 * @return bool
	 */
	public function retrieve()
	{
		$userId = session(self::AUTH_SESSION_KEY);

		if (Auth::check() && !empty($userId)) {
			\Auth::loginUsingId(\Auth::loginUsingId($userId));
			$this->request->session()->forget(self::AUTH_SESSION_KEY);

			return true;
		}

		return false;
	}

	/**
	 * La session actuelle est-elle déjà une session switchée
	 *
	 * @return bool
	 */
	public static function authIsSwitched()
	{
		return !empty(session(self::AUTH_SESSION_KEY));
	}
}
