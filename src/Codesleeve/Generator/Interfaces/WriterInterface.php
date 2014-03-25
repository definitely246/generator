<?php namespace Codesleeve\Generator\Interfaces;

/**
 * The goal of a writer interface is to
 * allow files to be written somewhere
 *
 */

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\HelperSet;

interface WriterInterface
{
	public function write(array $files, OutputInterface $output, HelperSet $helperSet);
}