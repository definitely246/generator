<?php

namespace spec\Codesleeve\Generator\Support;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Codesleeve\Generator\Interfaces\GeneratorCommandInterface;
use Codesleeve\Generator\Interfaces\ObjectCreatorInterface;
use Codesleeve\Generator\Interfaces\ContextInterface;
use Codesleeve\Generator\Interfaces\ParserInterface;
use Codesleeve\Generator\Interfaces\WriterInterface;


class ConfigSpec extends ObjectBehavior
{
	function it_is_initializable()
	{
		$this->shouldHaveType('Codesleeve\Generator\Support\Config');
	}

	function it_can_set_and_get_a_base_path()
	{
		$this->setBasePath('durka');
		$this->getBasePath()->shouldBe('durka');
	}

	function it_can_set_and_get_a_command(GeneratorCommandInterface $command)
	{
		$this->setCommand($command);
		$this->getCommand()->shouldBe($command);
	}

	function it_can_set_and_get_a_context(ContextInterface $context)
	{
		$this->setContext($context);
		$this->getContext()->shouldBe($context);
	}

	function it_can_set_and_get_a_parser(ParserInterface $parser)
	{
		$this->setParser($parser);
		$this->getParser()->shouldBe($parser);
	}

	function it_can_set_and_get_template()
	{
		$this->setTemplates(array('bob'));
		$this->getTemplates()->shouldBe(array('bob'));
	}

	function it_can_set_and_get_writer(WriterInterface $writer)
	{
		$this->setWriter($writer);
		$this->getWriter()->shouldBe($writer);
	}

	function it_can_set_and_get_all(GeneratorCommandInterface $command, ContextInterface $context, ParserInterface $parser, WriterInterface $writer)
	{
		$base_path = 'durka';
		$templates = array('templates');

		$all = compact('base_path', 'command', 'context', 'parser', 'writer', 'templates');
		$this->setAll($all);
		$this->getAll()->shouldBe($all);
	}

	function it_cannot_set_all_without_required_fields()
	{
		$this->shouldThrow('Codesleeve\Generator\Exceptions\MissingRequiredConfigOptionException')->during('setAll', array(array()));
	}

	function it_can_use_a_set_and_get_fields_by_key()
	{
		$this->set('cookie', 'monster');
		$this->get('cookie')->shouldBe('monster');
	}

	function it_can_create_a_generator_from_its_own_config(ObjectCreatorInterface $objectCreator)
	{
		$this->beConstructedWith($objectCreator);

		$objectCreator->create('ClassName', Argument::any())->willReturn('yep!');

		$this->set('command', 'ClassName');

		$this->generator()->shouldBe('yep!');
	}

	function it_can_handle_generation_of_empty_commands_without_fatal_error()
	{
		$this->shouldThrow('Codesleeve\Generator\Exceptions\InvalidGeneratorCommandException')->during('generator');
	}

}
