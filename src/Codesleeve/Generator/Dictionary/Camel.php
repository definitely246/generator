<?php namespace Codesleeve\Generator\Dictionary;

use Codesleeve\Generator\Support\Str;

class Camel extends Base
{
	/**
	 * Create studly versions of all the vocabulary in
	 * this template if they do not exist already. It is
	 * here that we are building up our dictionary (lexicon).
	 *
	 * @param  array $vocabulary
	 * @return void
	 */
	public function words($vocabulary)
	{
		foreach ($vocabulary as $token => $lexeme)
		{
			if (!is_string($lexeme)) continue;

			$key = $this->wrap(Str::camel($token));
			$value = Str::camel($lexeme);
			$tokens[$key] = $value;
		}

		return $tokens;
	}
}