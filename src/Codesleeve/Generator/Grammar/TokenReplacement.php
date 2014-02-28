<?php namespace Codesleeve\Generator\Grammar;

class TokenReplacement extends Base
{
	public function process($template, $tokens)
	{
		$content = $template->getContent();

		foreach ($tokens as $token => $lexeme)
		{
			$content = str_replace($token, $lexeme, $content);
		}

		$template->setContent($content);
	}
}