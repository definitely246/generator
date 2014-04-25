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

    function it_can_give_me_attributes()
    {
        $options = array('entity' => 'UserSettings', 'fields' => array('stripe_id:integer:unique', 'backup_email:string'));
        $context = $this->context($options);

        $context['attributes'][0]['name_unmodified']->shouldBe('stripe_id');
        $context['attributes'][1]['name_unmodified']->shouldBe('backup_email');

        $context['attributes'][0]['type']->shouldBe('integer');
        $context['attributes'][1]['type']->shouldBe('string');

        $context['attributes'][0]['index']->shouldBe('unique');
        $context['attributes'][1]['index']->shouldBe('');
    }

    // function it_can_give_me_belongs_to_relationship()
    // {
    //     $options = array('entity' => 'UserSettings', 'fields' => array('belongsTo:userAccounts'));
    //     $context = $this->context($options);

    //     $context->shouldHavePair('belongsTo', array(
    //         array('name' => 'userAccounts', 'Name' => 'UserAccounts', '_name_' => 'user_accounts', 'original' => 'userAccounts'),
    //     ));
    // }
}