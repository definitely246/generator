<?php

namespace spec\Codesleeve\Generator\Composers;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Codesleeve\Generator\Interfaces\FileCreatorInterface;

class FileWriterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Codesleeve\Generator\Composers\FileWriter');
    }

    function it_can_write_files(FileCreatorInterface $file)
    {
		$this->beConstructedWith($file);

		$file->create('test/thing.txt', 'content')->shouldBeCalled();

    	$this->write(array('test/thing.txt' => "content"));
    }
}