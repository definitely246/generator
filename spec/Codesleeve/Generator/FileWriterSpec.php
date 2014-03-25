<?php namespace spec\Codesleeve\Generator;

use spec\ObjectBehavior;
use Prophecy\Argument;

class FileWriterSpec extends ObjectBehavior
{
    function let($file, $output, $helperSet, $dialogHelper)
    {
        $file->beADoubleOf('Codesleeve\Generator\Interfaces\FilesystemInterface');
        $output->beADoubleOf('Symfony\Component\Console\Output\OutputInterface');
        $helperSet->beADoubleOf('Symfony\Component\Console\Helper\HelperSet');
        $dialogHelper->beADoubleOf('Symfony\Component\Console\Helper\DialogHelper');

        $this->beConstructedWith('/root/dir', $file);
    }

    function it_is_initializable($file)
    {
        $this->shouldHaveType('Codesleeve\Generator\FileWriter');
    }

    function it_can_write_files($file, $output, $helperSet)
    {
        $file->put('test/thing.txt', 'content')->shouldBeCalled();

        $file->exists('/root/dir/test/thing.txt')->willReturn(false);

        $helperSet->get()->shouldNotBeCalled();

        $this->write(array('test/thing.txt' => "content"), $output, $helperSet);
    }

    function it_will_prompt_the_user_for_input_if_a_file_is_going_to_be_overridden($file, $output, $helperSet, $dialogHelper)
    {
        $file->put('test/thing.txt', 'content')->shouldBeCalled();

        $file->exists('/root/dir/test/thing.txt')->willReturn(true);

        $helperSet->get("dialog")->willReturn($dialogHelper);

        $dialogHelper->askConfirmation(Argument::any(), Argument::any(), false)->willReturn(true);

        $this->write(array('test/thing.txt' => "content"), $output, $helperSet);
    }

    function it_will_not_override_the_file_if_the_user_answers_now($file, $output, $helperSet, $dialogHelper)
    {
        $file->put('test/thing.txt', 'content')->shouldBeCalled();

        $file->exists('/root/dir/test/thing.txt')->willReturn(true);

        $helperSet->get("dialog")->willReturn($dialogHelper);

        $dialogHelper->askConfirmation(Argument::any(), Argument::any(), false)->willReturn(true);

        $this->write(array('test/thing.txt' => "content"), $output, $helperSet);
    }

    function it_will_not_prompt_the_user_for_input_if_the_yes_flag_is_true($file, $output, $helperSet, $dialogHelper)
    {
        $file->put('test/thing.txt', 'content')->shouldNotBeCalled();

        $file->exists('/root/dir/test/thing.txt')->willReturn(true);

        $helperSet->get("dialog")->willReturn($dialogHelper);

        $dialogHelper->askConfirmation(Argument::any(), Argument::any(), false)->willReturn(false);

        $this->write(array('test/thing.txt' => "content"), $output, $helperSet);
    }
}