<?php namespace Codesleeve\Generator\Support;

use Codesleeve\Generator\Interfaces\ObjectCreatorInterface;

class ObjectCreator implements ObjectCreatorInterface
{
	public function create($className, array $params = array())
	{
		return new $className();
	}
}