<?php namespace Codesleeve\Generator;

class Template
{
	/**
	 * String of the template text, 
	 * this is what is used to generate
	 * the php code.
	 * 
	 * @var string
	 */
	protected $body;

	/**
	 * Contexts are run through an list of grammars
	 * to generate the source code that you will 
	 * see. It is processed in order.
	 * 
	 * @var array
	 */
	protected $grammars = array();

	/**
	 * Keeps track of the given context
	 * on this template
	 * 
	 * @var array
	 */
	protected $context = array();

	/**
	 * Create a new template to work with
	 * 
	 * @param  [type] $template
	 * @param  [type] $grammars
	 * @return [type]
	 */
	public function __construct($body, $grammars = null)
	{
		$this->body = $body;

		$this->grammars = $grammars ?: array(
			new Grammars\TokenReplacement
		);
	}

	/**
	 * Runs the context through the list of grammars
	 * and returns a compiled template
	 *  
	 * @param  array $context
	 * @return string
	 */
	public function compile(array $context)
	{
		$this->setContext($context);

		foreach ($this->grammars as $grammar)
		{
			$grammar->process($this);
		}

		return $this->body;
	}

	/**
	 * [getContext description]
	 * @return [type]
	 */
	public function getContext()
	{
		return $this->context;
	}

	/**
	 * [setContext description]
	 * @param [type] $context
	 */
	public function setContext($context)
	{
		$this->context = $context;
	}

	/**
	 * [getBody description]
	 * @return [type]
	 */
	public function getBody()
	{
		return $this->body;
	}

	/**
	 * [setBody description]
	 * @param [type] $body
	 */
	public function setBody($body)
	{
		$this->body = $body;
	}

	/**
	 * [getGrammars description]
	 * @return [type]
	 */
	public function getGrammars()
	{
		return $this->grammars;
	}

	/**
	 * [setGrammars description]
	 * @param [type] $grammars
	 */
	public function setGrammars($grammars)
	{
		$this->grammars = $grammars;
	}
}