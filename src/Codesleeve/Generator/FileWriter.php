<?php namespace Codesleeve\Generator;

use Codesleeve\Generator\Interfaces\WriterInterface;
use Codesleeve\Generator\Interfaces\FilesystemInterface;
use Codesleeve\Generator\Support\Filesystem;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\HelperSet;

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
	public function __construct($basePath, FilesystemInterface $file = null)
	{
		$this->basePath = $basePath;
		$this->file = $file ?: new Filesystem;
	}

	/**
	 * Writes out files using the filesystem dependency
	 *
	 * @param  array  $files
	 * @return void
	 */
	public function write(array $files, OutputInterface $output, HelperSet $helperSet, $options = array())
	{
		foreach ($files as $filename => $content)
		{
			if ($this->yes($filename, $output, $helperSet, $options))
			{
				$this->file->put($filename, $content);
			}
		}
	}

	/**
	 * If the user answers yes then we can override the file
	 * or if the file doesn't exist then we will just answer
	 * yes because we aren't overriding anything.
	 *
	 * @param  string 			$filename
	 * @param  OutputInterface	$output
	 * @param  HelperSet 		$helperSet
	 * @return boolean
	 */
	protected function yes($filename, $output, $helperSet, $options)
	{
		if (!$this->file->exists($this->basePath . '/' . $filename))
		{
			return true;
		}

		if (isset($options['yes']) && $options['yes'] == true)
		{
			return true;
		}

		$dialog = $helperSet->get('dialog');

		if ($dialog->askConfirmation($output,"<question>Would you like to override $filename? [y/N]</question>", false))
		{
			return true;
		}

		return false;
	}
}
