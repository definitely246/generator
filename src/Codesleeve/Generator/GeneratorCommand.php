<?php namespace Codesleeve\Generator;

use Codesleeve\Generator\Interfaces\GeneratorCommandInterface;
use Codesleeve\Generator\Interfaces\GeneratorConfigInterface;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command as BaseCommand;

class GeneratorCommand extends BaseCommand implements Interfaces\GeneratorCommandInterface
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
    	$description = $this->config->get('description', 'No description set.');

        $this->setName($name)
			 ->setDescription($description)
 			 ->addArgument('entity', InputArgument::REQUIRED, 'Entity we will be generating for')
 			 ->addArgument('fields', InputArgument::OPTIONAL, 'Fields for this given entity')
			 ->addOption('config', null, InputOption::VALUE_REQUIRED, 'Use your own generate.json files')
			 ->addOption('yes', null, InputOption::VALUE_NONE, 'Automatically answer yes to any prompts');
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
    	$options = array(
    		'entity' => $input->getArgument('entity'),
    		'fields' => $input->getArgument('fields'),
    		'yes' => $input->getOption('yes'),
    		'quiet' => $input->getOption('quiet'),
    	);

		// create variables from context with given $options
		$variables = $this->config->getContext()->context($options);

		// fetch the template structure and contents
		$templates = $this->config->getTemplates();

		// fetch the parser for this configuration setup
		$parser = $this->config->getParser();

		// generate parsed files with templates/variables
		$files = $parser->parse($templates, $variables);

		// write out the parsed files using the file writer
		$this->config->getWriter()->write($files, $output, $this->getHelperSet(), $options);
    }
}