<?php namespace Codesleeve\Generator\Interfaces;

interface ObjectCreatorInterface
{
	public function create($className, array $params = array());
}