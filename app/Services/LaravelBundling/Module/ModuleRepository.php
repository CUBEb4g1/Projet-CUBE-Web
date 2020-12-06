<?php

namespace App\Services\LaravelBundling\Module;

use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

/**
 * @version 1.0.0
 *
 * @author Alexis Weber
 */
class ModuleRepository
{
	/**
	 * Application instance
	 *
	 * @var Container
	 */
	protected $app;

	/**
	 * All the modules
	 *
	 * @var Module[]
	 */
	protected $modules = [];

	/**
	 * ModulesRepository constructor.
	 *
	 * @param Container $app
	 */
	public function __construct(Container $app)
	{
		$this->app = $app;
	}

	/**
	 * Detect all the modules and add them to $this->modules
	 */
	public function scan()
	{
		$manifests = glob(base_path().'/modules/*/module.json');

		foreach ($manifests as $manifestPath) {
			$manifest   = json_decode((file_get_contents($manifestPath)), true);
			$configPath = dirname($manifestPath).'/module-config.json';

			try {
				$config = json_decode(file_get_contents($configPath), true);
			} catch (\ErrorException $e) {
				$config = null;
			}

			$module = (new Module())
				->setManifest($manifest)
				->setConfig(new Config($configPath, $config));

			$this->add($module);
		}
	}

	/**
	 * Register and boot all the ServiceProviders from $this->modules
	 */
	public function boot()
	{
		foreach ($this->modules as $module) {
			if ($module->isEnabled()) {
				$class = $module->getManifest('provider');
				/** @var ServiceProvider $provider */
				$provider = new $class($this->app);

				$provider->register();
				$provider->boot();
			}
		}
	}

	/*
	|--------------------------------------------------------------------------
	| GETTERS SETTERS
	|--------------------------------------------------------------------------
	*/

	/**
	 * Return all the modules
	 *
	 * @return Module[]
	 */
	public function all()
	{
		return $this->modules;
	}

	/**
	 * Return a module by his name
	 *
	 * @param string $name
	 *
	 * @return Module|null
	 */
	public function find(string $name)
	{
		return $this->modules[$this->strToKebabCase($name)] ?? null;
	}

	/**
	 * Add a module to the modules list
	 *
	 * @param Module $module
	 */
	public function add(Module $module)
	{
		$this->modules[$this->strToKebabCase($module->getManifest('name'))] = $module;
	}

	/*
	|--------------------------------------------------------------------------
	| INTERNAL FUNCTIONS
	|--------------------------------------------------------------------------
	*/

	/**
	 * @param string $str
	 *
	 * @return string
	 *
	 * @internal
	 */
	final protected function strToKebabCase(string $str): string
	{
		$str = preg_replace('#[-_ ]#', '', ucwords($str, '-_ '));
		$str = preg_replace('/(?<!^)[A-Z]/', '-$0', $str);
		return strtolower($str);
	}
}
