<?php namespace Codesleeve\Generator\Interfaces;

interface ConfigFactoryInterface
{
    /**
     * Creates config from given paths and json config file
     *
     * @param  string $basePath
     * @param  string $scriptPath
     * @param  string $configFile
     * @return GeneratorConfigInterface[]
     */
    public function create($basePath, $scriptPath, $configFile);
}