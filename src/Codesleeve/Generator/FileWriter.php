<?php namespace Codesleeve\Generator;

use Codesleeve\Generator\Interfaces\WriterInterface;
use Codesleeve\Generator\Interfaces\FilesystemInterface;
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
	public function __construct(FilesystemInterface $file = null)
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
			$this->file->put($filename, $content);
		}
	}
}
