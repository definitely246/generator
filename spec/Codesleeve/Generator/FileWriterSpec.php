<?php namespace spec\Codesleeve\Generator;

use spec\ObjectBehavior;
use Prophecy\Argument;

use Codesleeve\Generator\Interfaces\FilesystemInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\HelperSet;

class FileWriterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
       $this->shouldHaveType('Codesleeve\Generator\FileWriter');
    }

    function it_can_write_files(FilesystemInterface $file, OutputInterface $output, HelperSet $helperSet)
    {
        $this->beConstructedWith($file);

        $file->put('test/thing.txt', 'content')->shouldBeCalled();

        $this->write(array('test/thing.txt' => "content"), $output, $helperSet);
    }

    function it_should_ask_when_overriding_files(FilesystemInterface $file)
    {

    }

    function it_can_use_input_and_output_from_symfony_console_to_ask_questions_and_get_responses()
    {

    }
}