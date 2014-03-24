<?php namespace Codesleeve\Generator\Interfaces;

interface FileCreatorInterface
{
	public function create($filename, $content);
}