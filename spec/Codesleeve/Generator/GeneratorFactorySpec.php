<?php namespace spec\Codesleeve\Generator;

use spec\ObjectBehavior;
use Prophecy\Argument;

use Codesleeve\Generator\Interfaces\ConfigFactoryInterface;
use Codesleeve\Generator\Interfaces\GeneratorConfigInterface;

class GeneratorFactorySpec extends ObjectBehavior
{
	static $default, $config;

	function let(ConfigFactoryInterface $configFactory, GeneratorConfigInterface $config)
	{
		static::$default = __DIR__ . "/../../../fixtures";

		static::$config = array('model' => $config);

		$this->beConstructedWith($configFactory);

		$config->generator()->willReturn('Here is the generator');

		$configFactory->create(getcwd(), static::$default, 'json')->willReturn(static::$config);
	}

    function it_is_initializable()
    {
         $this->shouldHaveType('Codesleeve\Generator\GeneratorFactory');
    }

    function it_can_get_all_generators_from_a_json_file()
    {
    	$this->all(getcwd(), static::$default, 'json')->shouldHavePair('model', 'Here is the generator');
    }
}
