<?php namespace spec\Codesleeve\Generator\Support;

use spec\ObjectBehavior;
use Prophecy\Argument;

use org\bovigo\vfs\vfsStream;

class FilesystemSpec extends ObjectBehavior
{
	function let()
	{
        $structure = array(
            'folder' => array(
                'test.txt' => 'hello there'
            )
        );

        vfsStream::setup('root', null, $structure);
		$root = vfsStream::url('root/');

		$this->beConstructedWith($root);
	}

    function it_is_initializable()
    {
        $this->shouldHaveType('Codesleeve\Generator\Support\Filesystem');
    }

    function it_can_get_files()
    {
        $this->get('folder/test.txt')->shouldBe('hello there');
    }

    function it_can_put_files()
    {
        $this->put('folder/test1.txt', 'did it work?');
        $this->get('folder/test1.txt')->shouldBe('did it work?');
    }

    function it_can_get_a_dirname_for_file()
    {
        $this->directory('folder/test.txt')->shouldBe('vfs://root/folder');
    }

    function it_can_get_all_the_files_and_their_contents_in_an_associative_array()
    {
        $this->getFileContentsFromDirectory('folder')->shouldHavePair('test.txt', 'hello there');
    }

    function it_can_make_paths_relative_to_a_base_path()
    {
        $this->makeRelativePath('vfs://root/folder/test.txt', 'vfs://root/folder')->shouldBe('test.txt');
    }

    function it_can_put_files_into_directories_that_do_not_exist_yet()
    {
        $this->put('folder/does/not/exist/test1.txt', 'did it work?');
    }
}
