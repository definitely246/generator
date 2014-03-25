<?php namespace spec\Codesleeve\Generator;

use spec\ObjectBehavior;
use Prophecy\Argument;

class EntityContextSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Codesleeve\Generator\EntityContext');
    }

    function it_can_give_me_plural_entity_names()
    {
    	$options = array('entity' => 'user');
    	$context = $this->context($options);

    	$context->shouldHavePair('entities', 'users');
        $context->shouldHavePair('Entities', 'Users');
    }

    function it_can_give_me_singular_entity_names()
    {
        $options = array('entity' => 'user');
        $context = $this->context($options);

        $context->shouldHavePair('entity', 'user');
        $context->shouldHavePair('Entity', 'User');
    }

    function it_can_give_me_snake_case_entities()
    {
        $options = array('entity' => 'UserSettings');
        $context = $this->context($options);

        $context->shouldHavePair('_entities_', 'user_settings');
        $context->shouldHavePair('_entity_', 'user_setting');
    }

    function it_can_give_me_camel_case_entities()
    {
        $options = array('entity' => 'UserSettings');
        $context = $this->context($options);

        $context->shouldHavePair('entities', 'userSettings');
        $context->shouldHavePair('entity', 'userSetting');
    }

    function it_can_give_me_studly_case_entities()
    {
        $options = array('entity' => 'UserSettings');
        $context = $this->context($options);

        $context->shouldHavePair('Entities', 'UserSettings');
        $context->shouldHavePair('Entity', 'UserSetting');
    }
}
