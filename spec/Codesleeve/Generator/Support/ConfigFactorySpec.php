<?php namespace spec\Codesleeve\Generator\Support;

use spec\ObjectBehavior;
use Prophecy\Argument;

use Codesleeve\Generator\Interfaces\FilesystemInterface;
use Codesleeve\Generator\Support\ObjectCreator;

class ConfigFactorySpec extends ObjectBehavior
{
    static $scriptPath;

    function let(FilesystemInterface $filesystem)
    {
        static::$scriptPath = __DIR__ . '/../../../fixtures';
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Codesleeve\Generator\Support\ConfigFactory');
    }

    // function it_can_read_valid_json_files()
    // {
    //     $config = $this->create(getcwd(), static::$scriptPath, static::$scriptPath . '/generator.json');

    //     $config['model']->getBasePath()->shouldBe(getcwd());
    //     $config['model']->getCommand()->shouldBe('Codesleeve\Generator\GeneratorCommand');
    //     $config['model']->getContext()->shouldHaveType('Codesleeve\Generator\EntityContext');
    //     $config['model']->getParser()->shouldHaveType('Codesleeve\Generator\TwigParser');
    // }

    // function it_does_not_squawk_on_json_files_that_do_not_exist()
    // {
    //     $config = $this->shouldThrow('Codesleeve\Generator\Exceptions\FileNotFoundException')->during('create', array(getcwd(), static::$scriptPath, static::$scriptPath . '/does-not-exist-generator.json'));
    // }

    // function it_can_get_templates_relative_to_script_path()
    // {
    //     $config = $this->create(getcwd(), static::$scriptPath, static::$scriptPath . '/generator.json');

    //     $config['model']->getTemplates()->shouldHaveKey('app/models/__Entity__.php');
    // }

    function it_can_get_templates_relative_to_config_directory()
    {
        $config = $this->create(getcwd(), static::$scriptPath, static::$scriptPath . '/configs/another-generator.json');

        $config['controller']->getTemplates()->shouldHaveKey('__Entity__Controller.php');
    }

    function it_can_use_a_template_directory_relative_to_current_working_directory_if_one_exists()
    {
        $config = $this->create(static::$scriptPath, 'some/bogus/directory', static::$scriptPath . '/generator.json');

        $config['model']->getTemplates()->shouldHaveKey('app/models/__Entity__.php');
    }

    function it_can_handle_invalid_json_files_gracefully()
    {
        $config = $this->shouldThrow('Codesleeve\Generator\Exceptions\InvalidJsonFileException')->during('create', array(getcwd(), static::$scriptPath, static::$scriptPath . '/invalid-json-generator.json'));
    }

    function it_can_handle_invalid_classes_in_the_json_file_gracefully()
    {
        $config = $this->shouldThrow('Codesleeve\Generator\Exceptions\InvalidJsonFileException')->during('create', array(getcwd(), static::$scriptPath, static::$scriptPath . '/invalid-class-generator.json'));
    }

    function it_can_handle_extra_stuff_from_json_files()
    {
        $config = $this->create(getcwd(), static::$scriptPath, static::$scriptPath . '/generator.json');

        $config['model']->getAll()->shouldHavePair('extra', 'stuff');
    }
}