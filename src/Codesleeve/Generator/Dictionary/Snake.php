<?php namespace Codesleeve\Generator\Dictionary;

use Codesleeve\Generator\Support\Str;

class Snake extends Base
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
			if (!is_string($lexeme)) continue;

			$key = $this->wrap('_' . Str::snake($token));
			$value = Str::snake($lexeme);
			$tokens[$key] = $value;
		}

		return $tokens;
	}
}