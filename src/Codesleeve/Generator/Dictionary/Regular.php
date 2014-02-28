<?php namespace Codesleeve\Generator\Dictionary;

use Codesleeve\Generator\Support\Str;

class Regular extends Base
{
	/**
	 *
	 * @param  array $vocabulary
	 * @return void
	 */
	public function words($vocabulary)
	{
		foreach ($vocabulary as $token => $lexeme)
		{
			$key = $this->wrap($token);
			$tokens[$key] = $lexeme;
		}

		return $tokens;
	}
}