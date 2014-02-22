<?php namespace Codesleeve\Generator;

use org\bovigo\vfs\vfsStream;

class EngineTest extends TestCase
{ 
    public function setUp()
    {
        $this->root = vfsStream::setup('root');

        $this->engine = new Engine;
    }

    public function testCanSetTemplateOnEngine()
    {
        $this->engine->setTemplate('template');
        $this->assertEquals('template', $this->engine->getTemplate());
    }

    public function testCanSetTemplateFileOnEngine()
    {
        $structure = array('test.txt' => 'template');

        $file = vfsStream::create($structure, $this->root);

        $this->engine->setTemplateFromFile(vfsStream::url('root/test.txt'));

        $this->assertEquals('template', $this->engine->getTemplate());
    }


}