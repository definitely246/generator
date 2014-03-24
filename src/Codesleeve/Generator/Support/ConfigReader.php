<?php namespace Codesleeve\Generator\Support;

use Codesleeve\Generator\Exceptions\TemplatesNotFoundException;

class ConfigReader
{
    /**
     * Default values for our config inputs
     *
     * @var array
     */
    protected $defaults = array(
        'context' => "Codesleeve\\Generator\\Contexts\\EntityContext",
        'parser' => "Codesleeve\\Generator\\Parsers\\TwigParser",
        'writer' => "Codesleeve\\Generator\\Composers\\FileWriter",
        'variables' => array(),
        'help' => 'No help text defined in config file. Sorry',
    );

    /**
     * A config reader takes a JSON file and makes a
     * Support\Config file from it with specific keys
     *
     * @param Config        $config
     * @param Filesystem    $file
     * @param ObjectCreator $objectCreator
     */
	public function __construct(GeneratorConfigInterface $config = null, Filesystem $file = null, ObjectCreator $objectCreator = null)
	{
        $this->config = $config ?: new GeneratorConfig;
        $this->file = $file ?: new Filesystem;
		$this->objectCreator = $objectCreator ?: new ObjectCreator;
	}

    /**
     * Gets the available types for our json (config) file
     *
     * @param  string $jsonFile
     * @return array
     */
    public function getAvailabeTypes($jsonFile)
    {
        $json = (array) $this->file->openAsJsonDocument($jsonFile);

        return array_keys($json);
    }

    /**
     * Let's us know if this is even an available type
     * to be called or not
     *
     * @param  string  $jsonFile
     * @param  string  $type
     * @return boolean
     */
    public function isAvailableType($jsonFile, $type)
    {
        return in_array($type, $this->getAvailabeTypes($jsonFile));
    }

    /**
     * Gets the help text for the give type, which can be
     * set up in the configuration file
     *
     * @param  string $jsonFile
     * @param  string $type
     * @return string
     */
    public function getHelpForType($jsonFile, $type)
    {
        $json = $this->file->openAsJsonDocument($jsonFile);

        return $json->$type->help;
    }

    /**
     * Get the configuration setup from the $jsonFile
     * file that we have, given a basepath and type
     * from the config file.
     *
     * If type does not exist then we throw an exception.
     *
     * @return array
     */
    public function getConfig($basePath, $jsonFile, $contextType)
    {
        $options = $this->setupOptions($basePath, $jsonFile, $contextType);

        $config = $this->config;

        $config->setBasePath($basePath);

        $config->setContext($this->context($options));

        $config->setParser($this->parser($options));

        $config->setTemplates($this->templates($options));

        return $config;
    }

    /**
     * Returns the context generator class for the given type
     * found in our options
     *
     * @param  array $options
     * @return ContextInterface
     */
    protected function context($options)
    {
        return $this->objectCreator->create($options['context']);
    }

    /**
     * REturns the parser class for the given type found
     * in our options
     *
     * @param array $options
     * @return ParserInterface
     */
    protected function parser($options)
    {
        return $this->objectCreator->create($options['parser']);
    }

    /**
     * This sets up the options that we will use to construct
     * a new GeneratorConfig from this ConfigReader
     *
     * @param  string $basePath
     * @param  string $jsonFile
     * @param  string $contextType
     * @return array
     */
    protected function setupOptions($basePath, $jsonFile, $contextType)
    {
        $json = $this->file->openAsJsonDocument($jsonFile);

        $options = array_merge($this->defaults, (array) $json->$contextType);

        $options['context_type'] = $contextType;

        $options['base_path'] = $basePath;

        $options['config_path'] = $this->file->directory($jsonFile);

        return $options;
    }

    /**
     * Returns the absolutePath to a template directory we
     * should use which can depend on several factors.
     *
     *   1. Hardcoded absolute path (use has hardcode it)
     *   2. Path relative to $basePath (only if exists)
     *   3. Path relative to config file (default should exist)
     *
     * @return string
     */
    protected function templates($options)
    {
        $directory = $this->getTemplateDirectory($options);

        return $this->file->getFileContentsFromDirectory($directory);
    }

    /**
     * Gets the template directory I should use
     * this configuration setup
     *
     * @param  array $options
     * @return string
     */
    protected function getTemplateDirectory($options)
    {
        $base = $options['base_path'];

        $default = $options['config_path'];

        $name = $options['templates'];

        if ($this->file->exists($name))
        {
            return $name;
        }

        if ($this->file->exists("{$base}/{$name}"))
        {
            return "{$base}/{$name}";
        }

        if ($this->file->exists("{$default}/{$name}"))
        {
            return "{$default}/{$name}";
        }

        throw new TemplatesNotFoundException("Could not resolve templates at {$name} for the given context type {$options['context_type']}");
    }
}
