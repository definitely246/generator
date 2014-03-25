<?php

namespace spec\Codesleeve\Generator\Console;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ApplicationSpec extends ObjectBehavior
{
	function let()
	{
		$this->beConstructedWith('Codesleeve Generator', '1.0.0');
	}

    function it_is_initializable()
    {
        $this->shouldHaveType('Codesleeve\Generator\Console\Application');
    }
}
