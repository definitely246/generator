<?php namespace Codesleeve\Generator\Dictionary;

class Base
{
	/**
	 * [$beginWith description]
	 * @var string
	 */
	protected $beginWith = "%";

	/**
	 * [$endWith description]
	 * @var string
	 */
	protected $endWith = "";

	/**
	 * Wraps the token with the $beginWith and $endWith
	 * strings
	 *
	 * @param  string $token
	 * @return string
	 */
	protected function wrap($token)
	{
		return $this->beginWith . $token . $this->endWith;
	}
}