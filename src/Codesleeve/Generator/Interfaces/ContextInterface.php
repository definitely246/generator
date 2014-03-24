<?php namespace Codesleeve\Generator\Interfaces;

/**
 * The goal of a context interface is to be
 * an arrayable type for Twig to consume and
 * is built from configuration
 */
interface ContextInterface
{
	public function context(array $parameters);
}