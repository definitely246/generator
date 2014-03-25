<?php namespace Codesleeve\Generator\Support;

use RecursiveIteratorIterator, RecursiveDirectoryIterator;
use Codesleeve\Generator\Interfaces\FilesystemInterface;

class Filesystem extends \Symfony\Component\Filesystem\Filesystem implements FilesystemInterface
{
	/**
	 * This is the root of the file system
	 * and can be used to inject in vfsStream for testing.
	 *
	 * It is also useful for having paths all relative to the
	 * root directory
	 *
	 * @var [type]
	 */
	private $root;

	/**
	 * Create a new filesystem wrapper
	 *
	 * @param string $root
	 */
	public function __construct($root = '')
	{
		$this->root = $root;
	}

	/**
	 * Open a file and return the contents
	 *
	 * @return string
	 */
	public function get($file)
	{
		return file_get_contents($file);
	}

	/**
	 * Create this file for us and set content
	 *
	 */
	public function put($filename, $content)
	{
		return file_put_contents($filename, $content);
	}

	/**
	 * Return the directory for this $file
	 *
	 * @param  string $file
	 * @return string
	 */
	public function directory($file)
	{
		return realpath(dirname($file));
	}

	/**
	 * Returns an array of file content from given directory
	 *
	 * @param  string $directory
	 * @return array
	 */
	public function getFileContentsFromDirectory($directory)
	{
		$contents = array();

		foreach (new RecursiveIteratorIterator (new RecursiveDirectoryIterator($directory)) as $filename)
		{
			if ($filename->isFile())
			{
				$relativePath = $this->makeRelativePath($filename, $directory);
				$contents[$relativePath] = $this->get($filename);
			}
		}

		return $contents;
	}

	/**
	 * Strip off the base directory
	 *
	 * @param  string $path
	 * @param  string $base
	 * @return string
	 */
	public function makeRelativePath($path, $base)
	{
		return str_replace($base . '/', '', $path);
	}
}