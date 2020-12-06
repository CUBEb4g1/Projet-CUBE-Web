<?php

namespace App\Services\LaravelBundling\Module;

/**
 * @version 1.0.0
 *
 * @author Alexis Weber
 */
class Config
{
	/**
	 * @var string
	 */
	protected $path;

	/**
	 * @var array
	 */
	protected $defaultConfig = [
		'enabled' => true,
	];

	/**
	 * @var array
	 */
	protected $config = [];

	/**
	 * Config constructor.
	 *
	 * @param string $path
	 * @param array|null $config
	 */
	public function __construct(string $path, array $config = null)
	{
		$this->path = $path;
		$this->mergeConfig($config ?? []);
	}

	/**
	 * Get the default config array
	 *
	 * @return array
	 */
	public function default()
	{
		return $this->defaultConfig;
	}

	/**
	 * Get all the config array
	 *
	 * @return array
	 */
	public function all()
	{
		return $this->config;
	}

	/**
	 * Get a config by its key
	 *
	 * @param string $key
	 * @param null $default
	 *
	 * @return mixed
	 */
	public function get(string $key, $default = null)
	{
		return $this->config[$key] ?? $default;
	}

	/**
	 * Merger a config with default configs
	 *
	 * @param array $config
	 */
	public function mergeConfig(array $config)
	{
		$this->config = $this->mergeRecursive($this->defaultConfig, $config);
	}

	/**
	 * Modify a config value and edit the module-config.json file
	 *
	 * @param string $key
	 * @param $value
	 */
	public function touch(string $key, $value)
	{
		$this->config[$key] = $value;
		file_put_contents($this->path, json_encode($this->config, JSON_PRETTY_PRINT));
	}

	/*
	|--------------------------------------------------------------------------
	| INTERNAL FUNCTIONS
	|--------------------------------------------------------------------------
	*/

	/**
	 * Merger deux tableaux ensemble récursivement en préservant les clefs numériques
	 *
	 * @param array $array1
	 * @param array $array2
	 *
	 * @return array
	 *
	 * @see array_replace_recursive()
	 * @see array_merge_recursive()
	 */
	final protected function mergeRecursive(array &$array1, array &$array2)
	{
		$merged = $array1;

		foreach ($array2 as $key => &$value) {
			if (is_array($value) && isset ($merged[$key]) && is_array($merged[$key])) {
				$merged[$key] = $this->mergeRecursive($merged[$key], $value);
			} else {
				if (is_numeric($key)) {
					$merged[] = $value;
				} else {
					$merged[$key] = $value;
				}
			}
		}

		return $merged;
	}
}
