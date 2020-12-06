<?php

return [[
	'text' => 'Accueil', 'route' => 'back.dashboard', 'icon' => 'fas fa-home-alt',
	'sub'  => [
		['text' => 'Account settings', 'route' => 'back.account.parameters'],
		['text' => 'Parameters', 'route' => 'back.settings.parameters'],
		[
			'text' => 'Menus', 'route' => 'back.menu.list',
			'sub'  => [
				['text' => 'Form', 'route' => 'back.menu.add'],
			],
		],
		[
			'text' => 'Pages', 'route' => 'back.page.list',
			'sub'  => [
				['text' => 'Form', 'route' => 'back.page.form'],
			],
		],
		['text' => 'Users', 'route' => 'back.user.list'],
		[
			'text' => 'Roles', 'route' => 'back.role.list',
			'sub'  => [
				['text' => 'Form', 'route' => 'back.role.form'],
			],
		],
		[
			'text' => 'Permissions', 'route' => 'back.permission.list',
			'sub'  => [
				['text' => 'Form', 'route' => 'back.permission.form'],
			],
		],
	],
]];
