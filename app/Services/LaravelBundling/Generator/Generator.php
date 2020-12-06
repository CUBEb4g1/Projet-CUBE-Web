<?php

namespace App\Services\LaravelBundling\Generator;

/**
 * @version 1.0.0
 *
 * @author Alexis Weber
 */
class Generator
{
	/**
	 * Module's location path
	 *
	 * @var string
	 */
	protected $path;

	/**
	 * PascalCase module name
	 *
	 * @var string
	 */
	protected $pcName;

	/**
	 * camelCase module name
	 *
	 * @var string
	 */
	protected $ccName;

	/**
	 * sneak_case module name
	 *
	 * @var string
	 */
	protected $scName;

	/**
	 * kebab-case module name
	 *
	 * @var string
	 */
	protected $kcName;

	/**
	 * Generator constructor.
	 *
	 * @param string $name
	 */
	public function __construct(string $name)
	{
		$this->setName($name);
		$this->path = base_path().'/modules/'.$this->pcName;
	}

	/**
	 * Generate the bundle
	 */
	public function generate()
	{
		$stubsPath = __DIR__.'/stubs';
		$rii       = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($stubsPath));

		// Create the base directory
		if (!file_exists($this->path)) {
			mkdir($this->path, 0750, true);
		}

		// Copy and generate all the stubs files
		foreach ($rii as $stub) {
			if (!$stub->isDir()) {
				// Directory where to create the new file
				$destinationDir = $this->path.'/'.str_replace($stubsPath, '', $stub->getPath());
				// Destination path with the filename
				$destinationPath = $destinationDir.'/'.preg_replace('#(.stub)$#', '', $stub->getFilename());
				$destinationPath = $this->replaceStubName($destinationPath);
				// Content of the new file
				$content = file_get_contents($stub->getPathName());
				$content = $this->replaceStubName($content);

				// Create the directory if needed
				if (!file_exists($destinationDir)) {
					mkdir($destinationDir, 0750, true);
				}
				// Create the new file
				file_put_contents($destinationPath, $content);
			}
		}
	}

	/**
	 * Replace the placeholders name with the differents formated module name
	 *
	 * @param string $str
	 *
	 * @return string
	 */
	protected function replaceStubName(string $str)
	{
		$str = preg_replace('#\$PC_NAME\$#', $this->pcName, $str);
		$str = preg_replace('#\$CC_NAME\$#', $this->ccName, $str);
		$str = preg_replace('#\$SC_NAME\$#', $this->scName, $str);
		$str = preg_replace('#\$KC_NAME\$#', $this->kcName, $str);

		return $str;
	}

	/*
	|--------------------------------------------------------------------------
	| GETTERS SETTERS
	|--------------------------------------------------------------------------
	*/

	/**
	 * @param string $str
	 *
	 * @return $this
	 */
	public function setName(string $str)
	{
		$this->pcName = $this->strToPascalCase($str);
		$this->ccName = $this->strToCamelCase($str);
		$this->scName = $this->strToSnakeCase($str);
		$this->kcName = $this->strToSnakeCase($str, '-');
		return $this;
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
	final protected function strToPascalCase(string $str): string
	{
		return preg_replace('#[-_ ]#', '', ucwords($str, '-_ '));
	}

	/**
	 * @param string $str
	 *
	 * @return string
	 *
	 * @internal
	 */
	final protected function strToCamelCase(string $str): string
	{
		return lcfirst($this->strToPascalCase($str));
	}

	/**
	 * @param string $str
	 *
	 * @return string
	 *
	 * @internal
	 */
	final protected function strToSnakeCase(string $str, string $separator = '_'): string
	{
		return strtolower(preg_replace('/(?<!^)[A-Z]/', $separator.'$0', $this->strToPascalCase($str)));
	}
}
