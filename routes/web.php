<?php

use App\Http\Controllers\Auth\AuthAsUserController;
use App\Http\Controllers\Back\AccountController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\NavMenuController;
use App\Http\Controllers\Back\PermissionController;
use App\Http\Controllers\Back\RoleController;
use App\Http\Controllers\Back\SettingsController;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\HomeController;
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

	// === Formulaire de contact ===
	Route::name('contact')->get('contact', [ContactController::class, 'form']);
	Route::post('contact', [ContactController::class, 'send']);

	Route::middleware(['auth', 'verified'])->group(function () {
		// .. Les utilisateurs doivent être connectés
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
});
