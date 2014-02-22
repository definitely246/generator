<?php namespace Codesleeve\Generator;

class Engine
{
	/**
	 * String of the template text, 
	 * this is what is used to generate
	 * the php code.
	 * 
	 * @var string
	 */
	private $template;

	/**
	 * How should we start an expression?
	 * 
	 * @var string
	 */
	private $startBlock = '<%';

	/**
	 * How should we close an expression?
	 * 
	 * @var string
	 */
	private $finishBlock = '%>';

	/**
	 * Get the starting block
	 * 
	 * @return string
	 */
	public function getStartBlock()
	{
		return $this->startBlock;
	}

	/**
	 * Get the finishing block
	 * 
	 * @return string
	 */
	public function getFinishBlock()
	{
		return $this->finishBlock;
	}

	/**
	 * Get the template
	 * 
	 * @return string
	 */
	public function getTemplate()
	{
		return $this->template;
	}

	/**
	 * Set template from string
	 * 
	 * @param string $template
	 * @return  void
	 */
	public function setTemplate($template)
	{
		$this->template = $template;
	}

	/**
	 * Set template from contents of file
	 * 
	 * @param  file $file
	 * @return void
	 */
	public function setTemplateFromFile($file)
	{
		$this->template = file_get_contents($file);
	}

}