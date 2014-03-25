<?php namespace Codesleeve\Generator\Support;

use Codesleeve\Generator\Exceptions\TemplatesNotFoundException;
use Codesleeve\Generator\Exceptions\InvalidJsonFileException;
use Codesleeve\Generator\Interfaces\ConfigFactoryInterface;
use Codesleeve\Generator\Interfaces\ObjectCreatorInterface;
use Codesleeve\Generator\Interfaces\FilesystemInterface;

class ConfigFactory implements ConfigFactoryInterface
{
    /**
     * Default values for our config inputs
     *
     * @var array
     */
    protected $defaults = array(
        'context' => "Codesleeve\\Generator\\EntityContext",
        'command' => "Codesleeve\\Generator\\GeneratorCommand",
        'parser' => "Codesleeve\\Generator\\TwigParser",
        'templates' => array(),
        'writer' => "Codesleeve\\Generator\\FileWriter",
    );

    /**
     * Setup the dependencies for this ConfigFactory
     *
     * @param FilesystemInterface      $file
     */
    public function __construct(FilesystemInterface $file = null, ObjectCreatorInterface $objectCreator = null)
    {
        $this->file = $file ?: new Filesystem;
        $this->objectCreator = $objectCreator ?: new ObjectCreator;
    }

    /**
     * Create the Config from given paths and json config file
     *
     * @param  string $basePath
     * @param  string $scriptPath
     * @param  string $configFile
     * @return GeneratorConfigInterface[]
     */
    public function create($basePath, $scriptPath, $configFile)
    {
        $configs = array();

        $jsonConfig = $this->getConfigFromJsonFile($configFile);

        foreach ($jsonConfig as $type => $json)
        {
            $configs[$type] = $this->createFor($json, $type, $basePath, $scriptPath);
        }

        return $configs;
    }

    /**
     * Create a GeneratorConfigInterface for this given input
     *
     * @param  array  $json
     * @param  string $type
     * @param  string $base_path
     * @param  string $script_path
     * @return GeneratorConfigInterface
     */
    protected function createFor($json, $type, $base_path, $script_path)
    {
        $config = $this->objectCreator->create('Codesleeve\Generator\Support\Config');

        $options = compact('type', 'base_path', 'script_path');

        $generator = array_merge($this->defaults, $options, $json);

        $generator['context'] = $this->objectCreator->create($generator['context']);

        $generator['parser'] = $this->objectCreator->create($generator['parser']);

        $generator['writer'] = $this->objectCreator->create($generator['writer']);

        $generator['templates'] = $this->getTemplates($generator);

        $config->setAll($generator);

        return $config;
    }

    /**
     * Get the config from JSON
     *
     * @param  string $configFile [description]
     * @return string             [description]
     */
    protected function getConfigFromJsonFile($configFile)
    {
        $json = json_decode($this->file->get($configFile), true);

        if (!$json)
        {
            $basename = basename($configFile);

            throw new InvalidJsonFileException("Could not parse json from {$basename}" . PHP_EOL . "Message: " . json_last_error_msg());
        }

        return $json;
    }

    /**
     * Create the template structure from given templates
     *
     * @param  array $generator
     * @return array
     */
    protected function getTemplates($generator)
    {
        $templates = $this->getTemplatesDirectory($generator);

        return $this->file->getFileContentsFromDirectory($templates);
    }

    /**
     * Gets the template directory I should use
     * this configuration setup since it can change
     * based on where you are at.
     *
     * @param  array $generator
     * @return string
     */
    protected function getTemplatesDirectory($generator)
    {
        $base = $generator['base_path'];

        $default = $generator['script_path'];

        $templates = $generator['templates'];

        if ($this->file->exists($templates))
        {
            return $templates;
        }

        if ($this->file->exists("{$base}/{$templates}"))
        {
            return "{$base}/{$templates}";
        }

        if ($this->file->exists("{$default}/{$templates}"))
        {
            return "{$default}/{$templates}";
        }

        throw new TemplatesNotFoundException("Could not resolve templates at {$templates} for the given context type {$generator['type']}");
    }
}


