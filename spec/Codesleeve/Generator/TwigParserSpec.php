<?php namespace spec\Codesleeve\Generator;

use spec\ObjectBehavior;
use Prophecy\Argument;

class TwigParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Codesleeve\Generator\TwigParser');
    }

    function it_can_parse_files_with_given_variables()
    {
    	$files = array(
            'app/models/__Entity__.php' => '<?php
                class {{Entity}} extends Eloquent
                {
                    public function add(${{entities}})
                    {
                        $this->add(${{entities}});
                    }
                }'
        );

    	$variables = array('Entity' => 'User', 'entities' => 'users');

    	$parsed = $this->parse($files, $variables);
        $parsed->shouldBeArray();
        $parsed->shouldHaveKey('app/models/User.php');
        $parsed['app/models/User.php']->shouldContain('$users');
        $parsed['app/models/User.php']->shouldContain('User');
    }

    function it_only_replaces_filenames_with_variables_that_are_strings()
    {
        $files = array(
            'app/models/__Entity__.php' => '<?php
                class {{Entity}} extends Eloquent
                {
                    public function add(${{entities}})
                    {
                        $this->add(${{entities}});
                    }
                }'
        );

        $variables = array('Entity' => 'User', 'entities' => 'users', 'somearray' => array('hmm'));

        $parsed = $this->parse($files, $variables);
        $parsed->shouldBeArray();
        $parsed->shouldHaveKey('app/models/User.php');
        $parsed['app/models/User.php']->shouldContain('$users');
        $parsed['app/models/User.php']->shouldContain('User');
    }
}
