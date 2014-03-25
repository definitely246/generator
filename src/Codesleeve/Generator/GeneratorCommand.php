<?php namespace Codesleeve\Generator;

use Codesleeve\Generator\Interfaces\GeneratorCommandInterface;
use Codesleeve\Generator\Interfaces\GeneratorConfigInterface;

class GeneratorCommand extends \Symfony\Component\Console\Command\Command implements Interfaces\GeneratorCommandInterface
{
	/**
	 * Construct a new generator!!! This thing is dynamic in nature though
	 * since it pretty much uses the config to configure itself.
	 *
	 * @param GeneratorConfigInterface $config
	 */
	public function __construct(GeneratorConfigInterface $config)
	{
		$this->config = $config;
		parent::__construct();
	}

	/**
	 * Configure yourself fool!
	 *
	 * @return void
	 */
    protected function configure()
    {
    	$name = $this->config->get('type', 'generator');
    	$description = $this->config->set('description', 'No description set.');

        $this->setName($name)
			 ->setDescription($description);
			 // ->addArgument('name', InputArgument::OPTIONAL, 'Who do you want to greet?')
			 // ->addOption('yell', null, InputOption::VALUE_NONE, 'If set, the task will yell in uppercase letters');
    }

    /**
     * Execute yourself fool!
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	$options = array();

		// create variables from context with given $options
		$variables = $this->config->getContext()->context($options);

		// fetch the template structure and contents
		$templates = $this->config->getTemplates();

		// fetch the parser for this configuration setup
		$parser = $this->config->getParser();

		// generate parsed files with templates/variables
		$files = $parser->parse($templates, $variables);

		// write out the parsed files using the file writer
		$this->config->getWriter()->write($input, $output, $files);
    }
}