<?php namespace Codesleeve\Generator;

use Codesleeve\Generator\Support\ConfigFactory;
use Codesleeve\Generator\Interfaces\ConfigFactoryInterface;

class GeneratorFactory
{
    public function __construct(ConfigFactoryInterface $configFactory = null)
    {
        $this->configFactory = $configFactory ?: new ConfigFactory;
    }

    /**
     * Get all the generators
     *
     * @param  string $basePath
     * @param  string $scriptPath
     * @param  string $configFile
     * @return array
     */
    public function all($basePath, $scriptPath, $configFile)
    {
        $configs = $this->configFactory->create($basePath, $scriptPath, $configFile);

        $generators = array();

        foreach ($configs as $name => $config)
        {
            $generators[$name] = $config->generator();
        }

        return $generators;
    }
}