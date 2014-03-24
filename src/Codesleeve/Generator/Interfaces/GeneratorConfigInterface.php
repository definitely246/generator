<?php namespace Codesleeve\Generator\Interfaces;

interface GeneratorConfigInterface
{
	public function getBasePath();
	public function getContext();
	public function getParser();
	public function getTemplates();
	public function getWriter();

	public function setBasePath($value);
	public function setContext(ContextInterface $value);
	public function setParser(ParserInterface $value);
	public function setTemplates(array $value);
	public function setWriter(WriterInterface $value);
}