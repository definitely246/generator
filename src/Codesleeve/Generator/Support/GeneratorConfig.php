<?php namespace Codesleeve\Generator\Support;

use Codesleeve\Generator\Interfaces\GeneratorConfigInterface;
use Codesleeve\Generator\Interfaces\ContextInterface;
use Codesleeve\Generator\Interfaces\ParserInterface;
use Codesleeve\Generator\Interfaces\WriterInterface;

class GeneratorConfig implements GeneratorConfigInterface
{
	/**
	 * Stores the path that we are running our
	 * generator from, which is where files would
	 * be written to
	 *
	 * @var string
	 */
	protected $basePath;

	/**
	 * Stores the context generator class which
	 * can create variables for us that are used
	 * by the parser
	 *
	 * @var ContextInterface
	 */
	protected $context;

	/**
	 * Stores the parser class which is
	 * used to create rendered templates
	 *
	 * @var ParserInterface
	 */
	protected $parser;

	/**
	 * Stores template structure and content
	 * which is used by the parser
	 *
	 * @var array
	 */
	protected $templates;

	/**
	 * Stores the writer class which can write
	 * out files given an array structure
	 *
	 * @var WriterInterface
	 */
	protected $writer;

	/**
	 * Accessor method
	 *
	 * @return string
	 */
	public function getBasePath()
	{
		return $this->basePath;
	}

	/**
	 * Accessor method
	 *
	 * @return ContextInterface
	 */
	public function getContext()
	{
		return $this->context;
	}

	/**
	 * Accessor method
	 *
	 * @return ParserInterface
	 */
	public function getParser()
	{
		return $this->parser;
	}

	/**
	 * Accessor method
	 *
	 * @return array
	 */
	public function getTemplates()
	{
		return $this->templates;
	}

	/**
	 * Accessor method
	 *
	 * @return WriterInterface
	 */
	public function getWriter()
	{
		return $this->writer;
	}

	/**
	 * Mutator method
	 *
	 * @param string $value
	 */
	public function setBasePath($value)
	{
		$this->basePath = $value;
	}

	/**
	 * Mutator method
	 *
	 * @param ContextInterface $value
	 */
	public function setContext(ContextInterface $value)
	{
		$this->context = $value;
	}

	/**
	 * Mutator method
	 *
	 * @param ParserInterface $value
	 */
	public function setParser(ParserInterface $value)
	{
		$this->parser = $value;
	}

	/**
	 * Mutator method
	 *
	 * @param array $value
	 */
	public function setTemplates(array $value)
	{
		$this->templates = $value;
	}

	/**
	 * Mutator method
	 *
	 * @param WriterInterface $value
	 */
	public function setWriter(WriterInterface $value)
	{
		$this->writer = $value;
	}
}