<?php namespace Codesleeve\Generator\Support;

use Codesleeve\Generator\Support\Str;
use Codesleeve\Generator\Dictionary\Base;

class Plural extends Base
{
	/**
	 * Create plural variables
	 *
	 * @param  [type] $template [description]
	 * @return [type]           [description]
	 */
	public function words($variables)
	{
		$plurals = array();

		foreach ($variables as $token => $lexeme)
		{
			list($token, $lexeme) = $this->createPlurals($token, $lexeme);

			if ($token)
			{
				$plurals[$token] = $lexeme;
			}
		}

		return $plurals;
	}

	/**
	 * Create plurals of all our variables in the list
	 *
	 * @param  [type] $token  [description]
	 * @param  [type] $lexeme [description]
	 * @return [type]         [description]
	 */
	protected function createPlurals($token, $lexeme)
	{
		if (is_string($lexeme))
		{
			return array(Str::plural($token), Str::plural($lexeme));
		}

		if (is_array($lexeme))
		{
			return array(null, null);
		}

		throw new Exception("Unknown type found for $token => $lexeme");
	}
}