<?php

namespace App\Providers;

use App\Models\Permission;
use App\Repositories\NavMenuRepository;
use Illuminate\Database\Schema\MySqlBuilder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot(MySqlBuilder $sqlBuilder)
	{
		// Fix pour MySQL
		$sqlBuilder->defaultStringLength(191);
		// Blade
		$this->_sharePermissionsToView();
		$this->_shareNavMenusToView();
		$this->_addFormBladeDirective();
		$this->_addSwitchedAuthBladeDirective();
		// Use Bootstrap paginator
		Paginator::useBootstrap();
	}

	/**
	 * Ajouter les clefs des Permissions dans les vues pour les utiliser sans devoir utiliser
	 * `use App\Models\Permission` dans les vues
	 */
	private function _sharePermissionsToView()
	{
		View::share('DEV', Permission::DEV);
		View::share('SWITCH_AUTH', Permission::SWITCH_AUTH);
		View::share('ACCESS_BACKOFFICE', Permission::ACCESS_BACKOFFICE);
	}

	/**
	 * Ajouter les menus enregistrés en cache dans les vues
	 */
	private function _shareNavMenusToView()
	{
		if (Schema::hasTable('pages')) {
			$repo  = new NavMenuRepository();
			$menus = $repo->allCached();
		} else {
			$menus = new Collection();
		}

		View::share('navMenus', $menus);
	}

	/**
	 * Champ de formulaire
	 * "@form()"
	 */
	private function _addFormBladeDirective()
	{
		Blade::directive('form', function ($expression) {
			return "<?php echo \App\Services\Form\Fields\Field::field({$expression}) ?>";
			/*			return "<?php echo \$__env->make({$expression})->render(); ?>";*/
		});
	}

	/**
	 * Directive Blade pour vérifier si la session utilisateur actuelle est en fait une session switchée
	 *
	 * @see AuthAsUserController
	 */
	private function _addSwitchedAuthBladeDirective()
	{
		Blade::directive('ifSwitchedAuth', function () {
			return "<?php if (\App\Services\Auth\SwitchSession::authIsSwitched()): ?>";
		});

		Blade::directive('endifSwitchedAuth', function () {
			return "<?php endif ?>";
		});
	}
}
