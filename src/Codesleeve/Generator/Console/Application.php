<?php namespace Codesleeve\Generator\Console;

use Codesleeve\Generator\GeneratorFactory;

class Application extends \Symfony\Component\Console\Application
{
	public function __construct($name, $version, GeneratorFactory $generatorFactory = null)
	{
		parent::__construct($name, $version);
		$this->generatorFactory = $generatorFactory ?: new GeneratorFactory;
	}

	/**
	 * This sets up all the generators we would need
	 * run given the config json file we are using
	 *
	 * @return void
	 */
	public function setupGenerators($currentDirectory, $pharDirectory)
	{
		$config = $this->getConfigFile($currentDirectory, $pharDirectory);

		if (!file_exists($config))
		{
			echo PHP_EOL . "Unable to open json file at $config" . PHP_EOL;
			exit;
		}

		$generators = $this->generatorFactory->all($currentDirectory, $pharDirectory, $config);

		foreach ($generators as $generator)
		{
			$this->add($generator);
		}
	}

	/**
	 * Get the config file
	 *
	 * @return
	 */
	protected function getConfigFile($currentDirectory, $pharDirectory)
	{
		$config = $this->getOption('config');

		if (!$config)
		{
		 	return file_exists("{$currentDirectory}/generator.json") ?
		 		"{$currentDirectory}/generator.json" :
		 		"{$pharDirectory}/generator.json";
		}

		if (strpos($config, '/') === 0)
		{
			return $config;
		}

		return "{$currentDirectory}/$config";
	}

	/**
	 * Get the option for the --config
	 * if one exists. This lets users override
	 * their config.json file at run time
	 * if they want too...
	 *
	 * @return null|string
	 */
	protected function getOption($searchFor, $default = null)
	{
		$arguments = $_SERVER['argv'];
		$searchFor = "--$searchFor=";

		foreach ($arguments as $argument)
		{
			if (strpos($argument, $searchFor) === 0)
			{
				return substr($argument, strlen($searchFor));
			}
		}

		return $default;
	}
}