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
		$config = getopt("c:");

		if (count($config) == 0)
		{
		 	return "{$pharDirectory}/generate.json";

		}
		$config = reset($config);

		if (strpos($config, '/') === 0)
		{
			return $config;
		}

		return "{$currentDirectory}/$config";
	}
}