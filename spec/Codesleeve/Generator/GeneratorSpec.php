<?php

namespace spec\Codesleeve\Generator;

use spec\ObjectBehavior;
use Prophecy\Argument;

class GeneratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Codesleeve\Generator\Generator');
    }

    function it_can_generate_an_entity_with_fields()
    {
        $options = array(
            'type' => 'model',
            'entity' => 'user',
            'fields' => 'email:string:unique password:string belongsTo:subscription belongsToMany:roles',
        );

       // $this->generate($options);
    }
}
