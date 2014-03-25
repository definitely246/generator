<?php

namespace spec\Codesleeve\Generator\Support;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FilesystemSpec extends ObjectBehavior
{
	function let()
	{
		// we need to pull in vfsStream here

		$root = '';
		$this->beConstructedWith($root);
	}

    function it_is_initializable()
    {
        $this->shouldHaveType('Codesleeve\Generator\Support\Filesystem');
    }

    function it_can_get_files()
    {

    }

    function it_can_put_files()
    {

    }

    function it_can_get_a_dirname_for_file()
    {

    }

    function it_can_get_all_the_files_and_their_contents_in_an_associative_array()
    {

    }

    function it_can_make_paths_relative_to_a_base_path()
    {

    }
}
