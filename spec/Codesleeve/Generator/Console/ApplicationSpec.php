<?php

namespace spec\Codesleeve\Generator\Console;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ApplicationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Codesleeve\Generator\Console\Application');
    }
}
