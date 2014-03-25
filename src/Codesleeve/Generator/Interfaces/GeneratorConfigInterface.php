<?php namespace Codesleeve\Generator\Interfaces;

interface GeneratorConfigInterface
{
	public function getAll();
	public function getBasePath();
	public function getCommand();
	public function getContext();
	public function getParser();
	public function getTemplates();
	public function getWriter();

	public function setAll(array $value);
	public function setBasePath($value);
	public function setCommand($value);
	public function setContext(ContextInterface $value);
	public function setParser(ParserInterface $value);
	public function setTemplates(array $value);
	public function setWriter(WriterInterface $value);

	public function generator();
	public function get($key, $default = null);
	public function set($key, $value);
}