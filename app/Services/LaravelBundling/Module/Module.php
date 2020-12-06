<?php

namespace App\Services\LaravelBundling\Module;

/**
 * @version 1.0.0
 *
 * @author Alexis Weber
 */
class Module
{
	/**
	 * Content of the manifest module.json
	 *
	 * @var
	 */
	protected $manifest;

	/**
	 * Config of the module
	 *
	 * @var Config
	 */
	protected $config;

	/**
	 * Return the complete manifest content or a specified key
	 *
	 * @param string|null $key
	 * @param mixed|null $default
	 *
	 * @return mixed
	 */
	public function getManifest(string $key = null, $default = null)
	{
		return $key !== null ? ($this->manifest[$key] ?? $default) : $this->manifest;
	}

	/**
	 * @param mixed $manifest
	 *
	 * @return Module
	 */
	public function setManifest(array $manifest)
	{
		$this->manifest = $manifest;
		return $this;
	}

	/**
	 * @return Config
	 */
	public function getConfig()
	{
		return $this->config;
	}

	/**
	 * @param Config $config
	 *
	 * @return Module
	 */
	public function setConfig(Config $config)
	{
		$this->config = $config;
		return $this;
	}

	/**
	 * Is the module enabled
	 *
	 * @return boolean
	 */
	public function isEnabled()
	{
		return (bool) $this->config->get('enabled');
	}

	public function enable()
	{
		$this->config->touch('enabled', true);
	}

	public function disable()
	{
		$this->config->touch('enabled', false);
	}
}
