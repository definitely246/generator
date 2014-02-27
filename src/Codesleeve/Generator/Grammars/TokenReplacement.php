<?php namespace Codesleeve\Generator\Grammars;

use Illuminate\Support\Str;

class TokenReplacement extends Base
{
	private $begin = "%";

	private $end = "%";

	/**
	 * Allows us to process a template
	 * 
	 * @param  [type] $body
	 * @param  [type] $context
	 * @return [type]
	 */
	public function process($template)
	{
		$body = $template->getBody();

		$body = str_replace('%Model%', 'User', $body);

		$template->setBody($body);
	}
}