<?php namespace spec\Codesleeve\Generator;

use spec\ObjectBehavior;
use Prophecy\Argument;

use Codesleeve\Generator\Interfaces\GeneratorConfigInterface;

class GeneratorCommandSpec extends ObjectBehavior
{
	function let(GeneratorConfigInterface $config)
	{
		$this->beConstructedWith($config);
	}

    function it_is_initializable()
    {
        $this->shouldHaveType('Codesleeve\Generator\GeneratorCommand');
    }
}
