<?php namespace Codesleeve\Generator\Composers;

use Codesleeve\Generator\Interfaces\WriterInterface;
use Codesleeve\Generator\Interfaces\FileCreatorInterface;
use Codesleeve\Generator\Support\Filesystem;

class FileWriter implements WriterInterface
{
	/**
	 * Used to write out files
	 *
	 * @var Filesystem
	 */
	protected $file;

	/**
	 * Creates a new file writer
	 *
	 * @param Filesystem $file
	 */
	public function __construct(FileCreatorInterface $file = null)
	{
		$this->file = $file ?: new Filesystem;
	}

	/**
	 * Writes out files using the filesystem dependency
	 *
	 * @param  array  $files
	 * @return void
	 */
	public function write(array $files)
	{
		foreach ($files as $filename => $content)
		{
			$this->file->create($filename, $content);
		}
	}
}
