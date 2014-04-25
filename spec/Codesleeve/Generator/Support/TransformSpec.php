<?php namespace spec\Codesleeve\Generator\Support;

use spec\ObjectBehavior;
use Prophecy\Argument;

class TransformSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Codesleeve\Generator\Support\Transform');
    }

    function it_can_transform_into_singular_studly()
    {
        $this->transformSingularStudly('entity', 'user_settings')->shouldBe(array('Entity', 'UserSetting'));
    }

    function it_can_transform_into_plural_studly()
    {
        $this->transformPluralStudly('entity', 'user_settings')->shouldBe(array('Entities', 'UserSettings'));
    }

    function it_can_transform_into_singular_snake()
    {
        $this->transformSingularSnake('entity', 'user_settings')->shouldBe(array('_entity_', 'user_setting'));
    }

    function it_can_transform_into_plural_snake()
    {
        $this->transformPluralSnake('entity', 'user_settings')->shouldBe(array('_entities_', 'user_settings'));
    }

    function it_can_transform_into_singular_camel()
    {
        $this->transformSingularCamel('entity', 'user_settings')->shouldBe(array('entity', 'userSetting'));
    }

    function it_can_transform_into_plural_camel()
    {
        $this->transformPluralCamel('entity', 'user_settings')->shouldBe(array('entities', 'userSettings'));
    }

    function it_can_transform_into_original()
    {
        $this->transformToOriginal('entity', 'user_setTings')->shouldBe(array('entity_unmodified', 'user_setTings'));
    }

    function it_can_transform_a_string_into_many_different_transforms_all_at_once()
    {
        $transform = $this->transformAll(array(), 'entity', 'userSetting');
        $transform->shouldHavePair('Entity', 'UserSetting');
        $transform->shouldHavePair('Entities', 'UserSettings');
        $transform->shouldHavePair('_entity_', 'user_setting');
        $transform->shouldHavePair('_entities_', 'user_settings');
        $transform->shouldHavePair('entity', 'userSetting');
        $transform->shouldHavePair('entities', 'userSettings');
        $transform->shouldHavePair('entity_unmodified', 'userSetting');
    }

}
