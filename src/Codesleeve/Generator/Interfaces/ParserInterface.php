<?php namespace Codesleeve\Generator\Interfaces;

/**
 * The goal of a context interface is to be
 * an arrayable type for Twig to consume and
 * is built from configuration
 */
interface ParserInterface
{
	public function parse(array $files, array $variables);
}