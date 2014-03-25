<?php

namespace spec\Codesleeve\Generator\Support;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ObjectCreatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Codesleeve\Generator\Support\ObjectCreator');
    }

    function it_can_create_objects()
    {
    	$this->create('StdClass')->shouldHaveType('StdClass');
    }
}
