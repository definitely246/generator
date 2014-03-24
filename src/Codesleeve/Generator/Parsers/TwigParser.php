<?php namespace Codesleeve\Generator\Parsers;

use Twig_Environment, Twig_Loader_Array, Twig_Lexer;
use Codesleeve\Generator\Interfaces\ParserInterface;
use Codesleeve\Generator\Interfaces\GeneratorConfigInterface;

class TwigParser implements ParserInterface
{
	/**
	 * Render all the files with the given context
	 * variables
	 *
	 * @param  array $files
	 * @param  array $variables
	 * @return array
	 */
	public function parse(array $files, array $variables)
	{
		$rendered = array();

		$twig = $this->twig($files, $variables);

		foreach ($files as $file => $content)
		{
			$filename = $this->filename($file, $variables);
			$rendered[$filename] = $twig->render($file, $variables);
		}

		return $rendered;
	}

	/**
	 * Get the filename which can have variables in it
	 * so we know how to write it out...
	 *
	 * @param  string $filename
	 * @param  array $variables
	 * @return string
	 */
	protected function filename($filename, $variables)
	{
		foreach ($variables as $key => $value)
		{
			$filename = str_replace("__{$key}__", $value, $filename);
		}

		return $filename;
	}

	/**
	 * Get a new twig parser from the given config options
	 *
	 * @param  array $filename
	 * @param  array $variables
	 * @return Twig_Environment
	 */
	protected function twig($files, $variables)
	{
        $loader = new Twig_Loader_Array($files);

        $twig = new Twig_Environment($loader);

        $this->lexer($twig);

        return $twig;
	}

	/**
	 * If I wanted to create a custom lexer for this
	 * twig I could, but I don't want to do this
	 *
	 * @param  Twig_Environment $twig
	 * @return void
	 */
	protected function lexer($twig)
	{
        // $options = array(
        //     'tag_comment'     => array('{#', '#}'),
        //     'tag_block'       => array('{%', '%}'),
        //     'tag_variable'    => array('{{', '}}'),
        //     'whitespace_trim' => '-',
        //     'interpolation'   => array('#{', '}'),
        // );
        // $lexer = new Twig_Lexer($twig, $options);
        // $twig->setLexer($lexer);
	}
}