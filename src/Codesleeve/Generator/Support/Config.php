<?php namespace Codesleeve\Generator\Support;

use Codesleeve\Generator\Exceptions\InvalidGeneratorCommandException;
use Codesleeve\Generator\Exceptions\MissingRequiredConfigOptionException;
use Codesleeve\Generator\Interfaces\GeneratorConfigInterface;
use Codesleeve\Generator\Interfaces\GeneratorCommandInterface;
use Codesleeve\Generator\Interfaces\ObjectCreatorInterface;
use Codesleeve\Generator\Interfaces\ContextInterface;
use Codesleeve\Generator\Interfaces\ParserInterface;
use Codesleeve\Generator\Interfaces\WriterInterface;

class Config implements GeneratorConfigInterface
{
	/**
	 * Store everything config item in here
	 *
	 * @var array
	 */
	protected $all = array();

	/**
	 * Since commands can be set in different ways
	 * we want to make sure we don't skip type checking
	 *
	 * @var array
	 */
	protected $setters = [
		'base_path' => 'setBasePath',
		'command' => 'setCommand',
		'context' => 'setContext',
		'parser' => 'setParser',
		'templates' => 'setTemplates',
		'writer' => 'setWriter'
	];

	public function __construct(ObjectCreatorInterface $objectCreator = null)
	{
		$this->objectCreator = $objectCreator ?: new ObjectCreator;
	}

	/**
	 * Get all the data;
	 *
	 * @return array
	 */
	public function getAll()
	{
		return $this->all;
	}

	/**
	 * Accessor method
	 *
	 * @return string
	 */
	public function getBasePath()
	{
		return $this->get('base_path');
	}

	/**
	 * Accessor method
	 *
	 * @return string
	 */
    public function getCommand()
    {
    	return $this->get('command');
    }

	/**
	 * Accessor method
	 *
	 * @return ContextInterface
	 */
	public function getContext()
	{
		return $this->get('context');
	}

	/**
	 * Accessor method
	 *
	 * @return ParserInterface
	 */
	public function getParser()
	{
		return $this->get('parser');
	}

	/**
	 * Accessor method
	 *
	 * @return array
	 */
	public function getTemplates()
	{
		return $this->get('templates');
	}

	/**
	 * Accessor method
	 *
	 * @return WriterInterface
	 */
	public function getWriter()
	{
		return $this->get('writer');
	}

	/**
	 * We need to run this through all our
	 * mutators just to do type checking
	 *
	 * @param array $all
	 */
	public function setAll(array $all)
	{
		$this->all = $all;

		foreach ($this->setters as $key => $setter)
		{
			if (!array_key_exists($key, $all))
			{
				throw new MissingRequiredConfigOptionException("Missing key '{$key}' when trying to mass assign Generator Config.");
			}

			$this->set($key, $all[$key]);
		}
	}

	/**
	 * Mutator method
	 *
	 * @param string $value
	 */
	public function setBasePath($value)
	{
		$this->all['base_path'] = $value;
	}

	/**
	 * Mutator method
	 *
	 * @param GeneratorConfigInterface $value
	 */
	public function setCommand($value)
	{
		$this->all['command'] = $value;
	}

	/**
	 * Mutator method
	 *
	 * @param ContextInterface $value
	 */
	public function setContext(ContextInterface $value)
	{
		$this->all['context'] = $value;
	}

	/**
	 * Mutator method
	 *
	 * @param ParserInterface $value
	 */
	public function setParser(ParserInterface $value)
	{
		$this->all['parser'] = $value;
	}

	/**
	 * Mutator method
	 *
	 * @param array $value
	 */
	public function setTemplates(array $value)
	{
		$this->all['templates'] = $value;
	}

	/**
	 * Mutator method
	 *
	 * @param WriterInterface $value
	 */
	public function setWriter(WriterInterface $value)
	{
		$this->all['writer'] = $value;
	}

	/**
	 * Dynamic accessor method
	 *
	 * @return GeneratorConfigInterface
	 */
	public function generator()
	{
		if (!$this->get('command'))
		{
			throw new InvalidGeneratorCommandException("The command was not set for this config so unable to create a generator!");
		}

    	return $this->objectCreator->create($this->get('command'), array($this));
	}

	/**
	 * An easy way to get any option on this config
	 *
	 * @param  string $name
	 * @param  any    $default
	 * @return any
	 */
	public function get($name, $default = null)
	{
		return array_key_exists($name, $this->all) ? $this->all[$name] : $default;
	}

	/**
	 * An easy way to set options on this config
	 *
	 * @param $name
	 * @param $value
	 */
	public function set($name, $value)
	{
		if (in_array($name, array_keys($this->setters)))
		{
			$command = $this->setters[$name];
			call_user_func_array(array($this, $command), array($value));
		}
		else
		{
			$this->all[$name] = $value;
		}
	}
}