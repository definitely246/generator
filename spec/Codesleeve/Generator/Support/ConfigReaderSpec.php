<?php

namespace spec\Codesleeve\Generator\Support;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConfigReaderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Codesleeve\Generator\Support\ConfigReader');
    }

    function it_can_give_me_a_valid_generator_config()
    {
        $base = __DIR__;
        $config = realpath("{$base}/../../../generator.json");
        $templateBase = dirname($config);

    	$config = $this->getConfig($base, $config, 'model');

        $config->getBasePath()->shouldBe($base);
        $config->getContext()->shouldHaveType('Codesleeve\Generator\Contexts\EntityContext');
        $config->getParser()->shouldHaveType('Codesleeve\Generator\Parsers\TwigParser');
        $config->getTemplates()->shouldHaveKey('app/models/__Entity__.php');
    }
}