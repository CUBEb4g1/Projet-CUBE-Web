<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Repositories\Facades\Settings;
use App\Services\LaravelBundling\Module\ModuleRepository;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
	/**
	 * Afficher le formulaire des paramètres
	 */
	public function parameters(ModuleRepository $moduleRepo)
	{
		return view('back.settings.parameters', [
			'settings' => Setting::all()->keyBy('name'),
			'modules'  => $moduleRepo->all(),
		]);
	}

	/**
	 * Submit du formulaire des paramètres
	 */
	public function saveParameters(Request $request)
	{
		foreach (Setting::all() as $setting) {
			if ($setting->type === 'boolean') {
				$value = $request->has($setting->name);
			} else {
				$value = $request->input($setting->name);
			}

			$setting->update(['value' => $value]);
		}

		Settings::clearCache();

		return redirect()->route('back.settings.parameters')
			->with('successNotif', __('notifications.common.saved'));
	}
}
