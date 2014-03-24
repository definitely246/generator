<?php namespace Codesleeve\Generator;

class Generator extends Support\Command
{
	public function __construct(Support\ConfigReader $configReader = null, $currentWorkingDirectory = __DIR__)
	{
		$this->configReader = $configReader ?: new Support\ConfigReader;
		$this->currentWorkingDirectory = realpath(__DIR__ . '/../../../');
	}

	/**
	 * Generate an example here
	 *
	 * @param  array $options
	 * @return void
	 */
	public function generate($options)
	{
		$base = $this->currentWorkingDirectory;
		$jsonFile = "{$base}/spec/generator.json";

		// get our config file that is generated from ConfigReader
		$config = $this->configReader->getConfig($base, $jsonFile, $options['type']);

		// create variables from context with given $options
		$variables = $config->getContext()->context($options);

		// fetch the template structure and contents
		$templates = $config->getTemplates();

		// fetch the parser for this configuration setup
		$parser = $config->getParser();

		// generate parsed files with templates/variables
		$files = $parser->parse($templates, $variables);

		// write out the parsed files using the file writer
		$config->getWriter()->write($files);
	}
}