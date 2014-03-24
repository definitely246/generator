<?php namespace Codesleeve\Generator\Interfaces;

/**
 * The goal of a writer interface is to
 * allow files to be written somewhere
 *
 */
interface WriterInterface
{
	public function write(array $files);
}