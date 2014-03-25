<?php namespace Codesleeve\Generator\Interfaces;

interface FilesystemInterface
{
	/**
	 * Open a file and return the contents
	 *
	 * @return string
	 */
	public function get($file);

	/**
	 * Create this file for us and set content
	 *
	 */
	public function put($filename, $content);

	/**
	 * Return the directory for this $file
	 *
	 * @param  string $file
	 * @return string
	 */
	public function directory($file);

	/**
	 * Returns an array of file content from given directory
	 *
	 * @param  string $directory
	 * @return array
	 */
	public function getFileContentsFromDirectory($directory);

	/**
	 * Strip off the base directory
	 *
	 * @param  string $path
	 * @param  string $base
	 * @return string
	 */
	public function makeRelativePath($path, $base);

	/**
	 * Check for the existence of this given path
	 *
	 * @param  string 	$path
	 * @return boolean
	 */
	public function exists($path);
}