<?php

include __DIR__.'/src/Deploy.php';

class DeployLaravel extends Deploy
{
	protected $workingDir = __DIR__.'/..';

	/**
	 * Commandes et directives à effectuer pour déployer le site
	 */
	protected function deploy()
	{
		$this->execAndLog('composer dump-autoload');
		$this->execAndLog('php artisan down --render="errors::503"');
		$this->execAndLog('composer install');
		$this->execAndLog('composer dump-autoload');
		$this->execAndLog('php artisan migrate --force');
		$this->execAndLog('php artisan storage:link');
		$this->execAndLog('php artisan assets_media:link');
		$this->execAndLog('php artisan module:link');
		$this->execAndLog('php artisan config:cache');
		// Gérer le cache avec traductions, remplace "php artisan route:cache"
		$this->execAndLog('php artisan route:trans:cache');
		$this->execAndLog('php artisan view:cache');
		$this->execAndLog('php artisan up');
		$this->execAndLog('npm ci');
		$this->execAndLog('npm run prod');
		$this->execAndLog('rm node_modules -rf');
	}
}

$deploy = new DeployLaravel();
$deploy->run();

exit;
