<?php namespace Codesleeve\Generator\Support;

use Codesleeve\Generator\Support\Str;
use Codesleeve\Generator\Dictionary\Base;

class Singular extends Base
{
	/**
	 * Create singular variables
	 *
	 * @param  [type] $template [description]
	 * @return [type]           [description]
	 */
	public function words($variables)
	{
		$singulars = array();

		foreach ($variables as $token => $lexeme)
		{
			list($token, $lexeme) = $this->createSingulars($token, $lexeme);

			if ($token)
			{
				$singulars[$token] = $lexeme;
			}
		}

		return $singulars;
	}

	/**
	 * Create singulars of all our variables in the list
	 *
	 * @param  [type] $token  [description]
	 * @param  [type] $lexeme [description]
	 * @return [type]         [description]
	 */
	protected function createSingulars($token, $lexeme)
	{
		if (is_string($lexeme))
		{
			return array(Str::singular($token), Str::singular($lexeme));
		}

		if (is_array($lexeme) && Str::plural($token) == $token)
		{
			return array(null, null);
		}
		else
		{
			throw new Exception("The lexical type for token $token is an array but it is a singular token. It needs to be plural.");
		}

		throw new Exception("Unknown type found for $token => $lexeme");
	}
}