<?php

use App\Http\Controllers\Auth\AuthAsUserController;
use App\Http\Controllers\Back\AccountController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\ManageResourcesController;
use App\Http\Controllers\Back\NavMenuController;
use App\Http\Controllers\Back\PermissionController;
use App\Http\Controllers\Back\RoleController;
use App\Http\Controllers\Back\SettingsController;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\Front\CommentController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ResourceController;
use App\Http\Controllers\Back\StatisticsController;
use App\Http\Controllers\Front\SearchController;
use App\Models\Permission;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

//=======================================================
//                         AUTH

Route::group([
	'prefix'     => LaravelLocalization::setLocale(),
	'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
	Auth::routes([
		'register' => settings('users_register'),
		'verify'   => true,
	]);

	Route::name('auth.switch')->post('auth-as', [AuthAsUserController::class, 'switchAuth'])->middleware(['auth']);
	Route::name('auth.switch.retrieve')->post('retrieve-auth', [AuthAsUserController::class, 'retrievePrevAuth']);
});

//=======================================================
//                         FRONT

Route::group([
	'prefix'     => LaravelLocalization::setLocale(),
	'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
	Route::name('home')->get('/', [HomeController::class, 'index']);

	// === Page de confidentialite ===
    Route::name('confidentiality')->get('confidentiality', [\App\Http\Controllers\Front\ConfidentialityController::class, 'confidentiality']);

	// === Page de profil ===
    Route::name('profile')->get('profile', [\App\Http\Controllers\Front\ProfileController::class, 'index']);
    Route::name('profile.resources')->get('profile/resources', [\App\Http\Controllers\Front\ProfileController::class, 'getUserResources']);

    // === Formulaire de contact ===
	Route::name('contact')->get('contact', [ContactController::class, 'form']);
	Route::post('contact', [ContactController::class, 'send']);

	// === Ressources === \\
    Route::name('front.resource_list')->get('resources/list', [ResourceController::class, 'getPreviewvalidatedlist']);
    Route::name('front.resource_get')->get('resources/get/{resource}', [ResourceController::class, 'getFullResource'])->where(['resource' => '\d*']);
    Route::get('resources/add', function() {
        return redirect()->route('home');
    });
    Route::name('search')->get('/s', [SearchController::class, 'index']);
    Route::name('toggle.favorite')->post('favorite}', [ResourceController::class, 'toggleFavorite']);
    Route::name('toggle.subscribe')->post('subscribe}', [ResourceController::class, 'toggleSubscribe']);

	Route::middleware(['auth', 'verified'])->group(function () {
		// .. Les utilisateurs doivent être connectés
        Route::name("front.resourcecreate")->get('resources/create', [ResourceController::class, 'create']);
        Route::name('front.resource_add')->post('resources/add', [ResourceController::class, 'add']);
        Route::name('front.resource_update_visibility')->post('resources/updateVisibility', [ResourceController::class, 'changeVisibility']);
        // === Comments ===
        Route::name('comments.store')->post('/comment/store', [CommentController::class, 'store']);
	});


});

//=======================================================
//                         ADMIN

Route::prefix(config('admin.backoffice_prefix'))->middleware(['auth', 'verified', 'permission:'.Permission::ACCESS_BACKOFFICE])->group(function () {
	Route::name('back.dashboard')->get('/', [DashboardController::class, 'index']);

	// === Menus ===
	Route::name('back.menu.list')->get('menu/{menu?}', [NavMenuController::class, 'list'])->where(['menu' => '\d*']);
	Route::name('back.menu.create')->get('menu/create', [NavMenuController::class, 'create']);
	Route::name('back.menu.add')->post('menu/add', [NavMenuController::class, 'add']);
	Route::name('back.menu.update')->post('menu/update/{menu}', [NavMenuController::class, 'update'])->where(['menu' => '\d*']);
	Route::name('back.menu.delete')->get('menu/delete/{menu}', [NavMenuController::class, 'delete'])->where(['menu' => '\d*']);
	Route::name('back.menu.add_item')->post('menu/add-item/{menu}', [NavMenuController::class, 'ajaxAddItem']);
	Route::name('back.menu.delete_item')->get('menu/delete-item/{item}', [NavMenuController::class, 'ajaxDeleteItem']);

	// === CRUD users ===
	Route::name('back.user.list')->get('user', [UserController::class, 'list']);
	Route::name('back.user.form')->get('user/form/{user?}', [UserController::class, 'form'])->where(['user' => '\d*']);
	Route::name('back.user.save')->post('user/form/{user?}', [UserController::class, 'save'])->where(['user' => '\d*']);
	Route::name('back.user.delete')->get('users/delete/{user}', [UserController::class, 'delete'])->where(['user' => '\d+']);

	// === STATISTIQUE ===
    Route::name('back.stats.list')->get('stats', [StatisticsController::class, 'list']);
//    Route::name('back.stats.users')->get('stats/users', [StatisticsController::class, 'users']);
    Route::name('back.stats.resources')->get('stats/resources', [StatisticsController::class, 'resources']);

	// === Paramètres compte utilisateur ===
	Route::name('back.account.parameters')->get('account/parameters', [AccountController::class, 'parameters']);
	Route::name('back.account.parameters.save')->post('account/parameters', [AccountController::class, 'saveParameters']);

	Route::middleware(['permission:'.Permission::DEV])->group(function () {
		// === CRUD roles ===
		Route::name('back.role.list')->get('role', [RoleController::class, 'list']);
		Route::name('back.role.form')->get('role/form/{role?}', [RoleController::class, 'form'])->where(['role' => '\d*']);
		Route::name('back.role.save')->post('role/form/{role?}', [RoleController::class, 'save'])->where(['role' => '\d*']);
		Route::name('back.role.delete')->get('role/delete/{role}', [RoleController::class, 'delete'])->where(['role' => '\d+']);

		// === CRUD permissions ===
		Route::name('back.permission.list')->get('permission', [PermissionController::class, 'list']);
		Route::name('back.permission.form')->get('permission/form/{permission?}', [PermissionController::class, 'form'])->where(['permission' => '\d*']);
		Route::name('back.permission.save')->post('permission/form/{permission?}', [PermissionController::class, 'save'])->where(['permission' => '\d*']);
		Route::name('back.permission.delete')->get('permission/delete/{permission}', [PermissionController::class, 'delete'])->where(['permission' => '\d+']);

        // === Settings ===
		Route::name('back.settings.parameters')->get('settings/parameters', [SettingsController::class, 'parameters']);
		Route::name('back.settings.parameters')->post('settings/parameters', [SettingsController::class, 'saveParameters']);
	});

    Route::middleware(['permission:'.Permission::ADMIN_TOOLS])->group(function () {
        // === CRUD categories ===
        Route::name('back.category.list')->get('category', [CategoryController::class, 'list']);
        Route::name('back.category.form')->get('category/form/{category?}', [CategoryController::class, 'form'])->where(['category' => '\d*']);
        Route::name('back.category.save')->post('category/form/{category?}', [CategoryController::class, 'save'])->where(['category' => '\d*']);
        Route::name('back.category.delete')->get('category/delete/{category}', [CategoryController::class, 'delete'])->where(['category' => '\d+']);
    });

    // === Gestion des Ressources === \\
    Route::name('back.resources.list.validated')->get('resources/validated{query?}', [ManageResourcesController::class, 'listValidated']);
    Route::name('back.resources.list.rejected')->get('resources/rejected{query?}', [ManageResourcesController::class, 'listRejected']);
    Route::name('back.resources.list.delete')->get('resources/deleted{query?}', [ManageResourcesController::class, 'listDeleted']);
    Route::name('back.resources.list.pending')->get('resources/pending{query?}', [ManageResourcesController::class, 'listPending']);
    Route::name('back.resources.list')->get('resources{query?}', [ManageResourcesController::class, 'listAll']);


    Route::name('back.resources.form')->get('resources/form/{resource}', [ManageResourcesController::class, 'form'])->where(['resource' => '\d*']);
    Route::name('back.resources.validate')->get('resources/validate/{resource}', [ManageResourcesController::class, 'validateResource'])->where(['resource' => '\d*']);
    Route::name('back.resources.refuse')->get('resources/refuse/{resource}', [ManageResourcesController::class, 'refuseResource'])->where(['resource' => '\d*']);
    Route::name('back.resources.restore')->get('resources/restore/{resource}', [ManageResourcesController::class, 'restoreResource'])->where(['resource' => '\d*']);
    Route::name('back.resources.delete')->get('resources/delete/{resource}', [ManageResourcesController::class, 'delete'])->where(['resource' => '\d+']);
});
