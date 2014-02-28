<?php namespace Codesleeve\Generator;

class Parser
{
	/**
	 * Available list of vocabularies that we will build
	 * upon when parsing this template.
	 *
	 * @var array
	 */
	protected $dictionary;

	/**
	 * A template is run through an list of grammar
	 * in this order, which can change the change the
	 * body of the template.
	 *
	 * @var array
	 */
	protected $grammar;

	/**
	 * Create a new template to work with
	 *
	 * @param  [type] $template
	 * @param  [type] $grammar
	 * @return [type]
	 */
	public function __construct()
	{
		$this->plural = new Support\Plural;
		$this->singular = new Support\Singular;

		$this->dictionary = array(
			new Dictionary\Studly,
			new Dictionary\Camel,
			new Dictionary\Snake,
			new Dictionary\Regular,
		);

		$this->grammar = array(
			new Grammar\TokenReplacement
		);
	}

	/**
	 * Runs the context through the list of grammar
	 * and returns a compiled template
	 *
	 * @param  array $context
	 * @return string
	 */
	public function parse(Template $template)
	{
		$tokens = array();
		$vocabulary = $this->generateVocabulary($template);

		var_dump($vocabulary);

		foreach ($this->dictionary as $dictionary)
		{
			$tokens = array_merge($tokens, $dictionary->words($vocabulary));
		}

		var_dump($tokens);

		// foreach ($this->grammar as $grammar)
		// {
		// 	$grammar->process($template, $tokens);
		// }


		return $template->getContent();
	}

	public function generateVocabulary($template)
	{
		$variables = $template->getVariables();

		$plural = $this->plural->words($variables);
		$singular = $this->singular->words($variables);

		return array_merge($plural, $singular, $variables);
	}

	/**
	 * [getGrammar description]
	 * @return [type]
	 */
	public function getGrammar()
	{
		return $this->grammar;
	}

	/**
	 * [setGrammar description]
	 * @param [type] $grammar
	 */
	public function setGrammar($grammar)
	{
		$this->grammar = $grammar;
	}
}