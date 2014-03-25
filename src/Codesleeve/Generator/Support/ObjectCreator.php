<?php namespace Codesleeve\Generator\Support;

use ReflectionClass;
use Codesleeve\Generator\Interfaces\ObjectCreatorInterface;

class ObjectCreator implements ObjectCreatorInterface
{
	public function create($className, array $params = array())
	{
		$class = new ReflectionClass($className);

		return $class->newInstanceArgs($params);
	}
}