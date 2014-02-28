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
	protected $content;

	/**
	 * Keeps track of the given variables
	 * on this template.
	 *
	 * @var array
	 */
	protected $variables;

	/**
	 * Create a new template to work with
	 *
	 * @param string $content
	 * @param array  $variables
	 */
	public function __construct($content = "", $variables = array())
	{
		$this->content = $content;
		$this->setVariables($variables);
	}

	/**
	 * [getContent description]
	 * @return [type]
	 */
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * [setContent description]
	 * @param [type] $content
	 */
	public function setContent($content)
	{
		$this->content = $content;
	}

	/**
	 * [getVariables description]
	 * @return [type]
	 */
	public function getVariables()
	{
		return $this->variables;
	}

	/**
	 * [setVariables description]
	 * @param [type] $variables
	 */
	public function setVariables($variables)
	{
		if (is_string($variables))
		{
			$variables = $this->parseJsonToAssociativeArray($variables);
		}

		$this->variables = $variables;
	}

	/**
	 * [parseJsonToAssociativeArray description]
	 * @param  [type] $json [description]
	 * @return [type]       [description]
	 */
	protected function parseJsonToAssociativeArray($json)
	{
		$obj = json_decode($json);

		if (!$obj)
		{
			throw new \Exception('Cannot parse this json string!');
		}

		return $this->toArray($obj);
	}

	/**
	 * [toArray description]
	 * @param  [type] $obj [description]
	 * @return [type]      [description]
	 */
	protected function toArray($obj)
	{
		$obj = (array) $obj;

		// convert underlying objects to associative arrays
		foreach ($obj as $key => $value)
		{
			if (!is_string($value))
			{
				$obj[$key] = $this->toArray($value);
			}
		}

		return $obj;
	}
}