<?php namespace Codesleeve\Generator\Dictionary;

use Codesleeve\Generator\Support\Str;

class Studly extends Base
{
	/**
	 * @param  array $vocabulary
	 * @return void
	 */
	public function words($vocabulary)
	{
		foreach ($vocabulary as $token => $lexeme)
		{
			if (!is_string($lexeme)) continue;

			$key = $this->wrap(Str::studly($token));
			$value = Str::studly($lexeme);
			$tokens[$key] = $value;
		}

		return $tokens;
	}
}