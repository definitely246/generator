<?php

namespace spec\Codesleeve\Generator\Support;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StrSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Codesleeve\Generator\Support\Str');
    }
}
